<?php

namespace Elasticsearchphp\Requests;


use Elasticsearchphp\Exceptions;
use Elasticsearchphp\Responses\IndexResponse;

/**
 * This class facilitates indexing single documents into an ElasticSearch index
 */
class IndexDocumentRequest extends Request
{
    protected $dispatcher;

    /**
     * @var array
     */
    protected $params;

    /** @var Command */
    private $currentCommand;


    /**
     * @param  \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
     *
     * @throws \Elasticsearchphp\Exceptions\ElasticsearchphpException
     * @internal param $node
     */
    public function __construct($dispatcher)
    {
        if (!isset($dispatcher)) {
            throw new \Elasticsearchphp\Exceptions\ElasticsearchphpException("Dispatcher argument required for IndexRequest");
        }

        $this->dispatcher = $dispatcher;

        $this->params['index'] = array();
        $this->params['type']  = array();

        $this->currentCommand   = null;
        $this->params['update'] = false;

        $this->params['updateScript'] = null;
        $this->params['updateParams'] = null;
        $this->params['updateUpsert'] = null;
        $this->params['doc']          = null;

        parent::__construct($dispatcher);
    }


    /**
     * @param $name
     * @param $args
     *
     * @return IndexDocumentRequest
     */
    public function __call($name, $args)
    {
        $this->params[$name] = $args[0];

        return $this;
    }


    /**
     * Set the index to add documents to
     *
     * @param  string               $index     indices to query
     * @param  string               $index,... indices to query
     *
     * @return IndexDocumentRequest
     */
    public function index($index)
    {
        $this->params['index'] = array();
        $args                  = func_get_args();
        foreach ($args as $arg) {
            $this->params['index'][] = $arg;
        }

        return $this;
    }


    /**
     * Set the type to add documents to
     *
     * @param  string               $type
     * @param  string               $type,...
     *
     * @return IndexDocumentRequest
     */
    public function type($type)
    {
        $this->params['type'] = array();
        $args                 = func_get_args();
        foreach ($args as $arg) {
            $this->params['type'][] = $arg;
        }

        return $this;
    }


    /**
     * @param string $script
     *
     * @return $this
     */
    public function updateScript($script)
    {
        $this->params['updateScript'] = $script;
        $this->currentCommandCheck();
        return $this;
    }


    /**
     * @param array $params
     *
     * @return $this
     */
    public function updateParams($params)
    {
        $this->params['updateParams'] = $params;
        $this->currentCommandCheck();
        return $this;
    }


    /**
     * @param string $upsert
     *
     * @return $this
     */
    public function updateUpsert($upsert)
    {
        $this->params['updateUpsert'] = $upsert;
        $this->currentCommandCheck();
        return $this;
    }


    /**
     * The document to index
     *
     * @param string|array $value
     * @param null           $id
     * @param bool|null       $update
     *
     * @throws \Elasticsearchphp\Exceptions\RuntimeException
     * @return IndexDocumentRequest
     */
    public function document($value, $id = null, $update = false)
    {
        if (!$this->batch instanceof BatchCommand) {
            throw new \RuntimeException("Cannot add a new document to an external BatchCommandInterface");
        }

        if (is_string($value)) {
            $value = json_decode($value, true);
        }

        foreach ($value as $index => $val) {
            if ($val instanceof \MongoId) {
                $value[$index] = (string)$val;
            } elseif ($val instanceof \MongoDate) {
                $value[$index] = date('Y-m-d H:i:s', $val->sec);
            } elseif ($val instanceof \DateTime) {
                $value[$index] = $val->format('Y-m-d H:i:s');
            } elseif (is_array($val)) {
                unset($value[$index]);
            }
        }

        $this->finalizeCurrentCommand();

        if (array_key_exists('_id', $value)) {
            $id = $value['_id'];
        }

        $this->params['doc'] = $value;

        if ($id !== null) {
            $this->currentCommand->id($id)->action('put');
            $this->params['update'] = $update;
        } else {
            $this->currentCommand->action('post');
            $this->params['update'] = false;
        }


        return $this;
    }


    /**
     * Accepts an array of Commands or a BatchCommand
     *
     * @param array|BatchCommandInterface $values
     *
     * @return $this
     * @throws \Elasticsearchphp\Exceptions\ElasticsearchphpException
     */
    public function documents($values)
    {
        if ($values instanceof BatchCommandInterface) {
            $this->batch = $values;
        } elseif (is_array($values)) {

            $isBatch = true;
            $batch   = new BatchCommand();

            /**
             * @param mixed $value
             */
            $map = function ($value) use ($isBatch, $batch) {
                if (!$value instanceof Command) {
                    $isBatch = false;
                } else {
                    $batch->addCommand($value);
                }
            };

            array_map($map, $values);

            if (!$isBatch) {
                throw new Exceptions\ElasticsearchphpException("If an array is supplied, all elements must be a Command object.");
            }

            $this->batch = $batch;

        } else {
            throw new Exceptions\ElasticsearchphpException("Documents method only accepts arrays of Commands or BatchCommandInterface objects");
        }

        return $this;

    }


    /**
     * Perform the indexing operation
     *
     * @throws \RuntimeException
     * @return \Elasticsearchphp\Responses\IndexResponse
     */
    public function execute()
    {

        /*
        foreach (array('index', 'type') as $key) {
            if (!isset($this->params[$key])) {
                                throw new \RuntimeException($key." cannot be empty.");
            }
        }

        foreach (array('index', 'type') as $key) {
            if (count($this->params[$key]) > 1) {
                                throw new \RuntimeException("Only one ".$key." may be inserted into at a time.");
            }
        }

        */


        $this->finalizeCurrentCommand();

        //if this is an internal Elasticsearchphp BatchCommand, make sure index/types/action are filled
        if ($this->batch instanceof BatchCommand) {
            if (isset($this->params['index'][0])) {
                $this->batch->fillIndex($this->params['index'][0]);
            }

            if (isset($this->params['type'][0])) {
                $this->batch->fillType($this->params['type'][0]);
            }

        }

        return parent::execute();
    }


    /**
     *This is all horribly terible and will be ripped out as soon as possible.
     *
     * Basically, This class stores an intermediate Command that maintains state across
     * chained requests, which allows updates (scripts, params, etc) to affect it.
     *
     * The command is finalized when a new document is added, or the request is executed.
     * Finalization means collapsing the doc field data into a param, as well as updating
     * the action/suffix as necessary.
     */
    private function finalizeCurrentCommand()
    {

        if ($this->batch instanceof BatchCommand && $this->currentCommand !== null) {

            if (isset($this->params['update']) && $this->params['update'] === true) {
                $this->currentCommand->action('post')->suffix('_update');


                if ($this->params['doc'] !== null) {
                    $data["doc"] = $this->params['doc'];
                }

                if ($this->params['updateScript'] !== null) {
                    $data["script"] = $this->params['updateScript'];
                }

                if ($this->params['updateParams'] !== null) {
                    $data["params"] = $this->params['updateParams'];
                }

                if ($this->params['updateUpsert'] !== null) {
                    $data["upsert"] = $this->params['updateUpsert'];
                }

                $this->currentCommand->data($data);

            } else {
                $this->currentCommand->data($this->params['doc']);
            }

            $this->batch->addCommand($this->currentCommand);

            $this->params['update'] = false;
        }

        $this->currentCommand = new Command();
    }


    /**
     * Simple helper function to check if the current command is populated
     * If not, create a new one
     */
    private function currentCommandCheck()
    {
        $this->params['update'] = true;
        if ($this->currentCommand === null) {
            $this->currentCommand = new Command();
        }

    }

    /**
     * @param $response
     * @return \Elasticsearchphp\Responses\IndexResponse|\Elasticsearchphp\Responses\Response
     */
    protected function getReturnResponse($response)
    {
        return new IndexResponse($response);
    }

}