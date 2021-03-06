<?php

namespace Elasticsearchphp\Requests;

use Elasticsearchphp\common\exceptions;
use Elasticsearchphp\components;
use Elasticsearchphp\components\queries;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Elasticsearchphp\components\FacetInterface;
use Elasticsearchphp\responses\DocumentResponse;

/**
 * SearchRequest facilitates document retrieval by id
 */
class GetDocumentRequest extends Request
{
    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected $dispatcher;

    protected $params;


    /**
     * @param  \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
     *
     * @throws \Elasticsearchphp\Exceptions\BadMethodCallException
     */
    public function __construct($dispatcher)
    {
        if (!isset($dispatcher)) {
            throw new \Elasticsearchphp\Exceptions\BadMethodCallException("Dispatcher argument required for DocumentRequest");
        }

        $this->dispatcher       = $dispatcher;

        parent::__construct($dispatcher);
    }

    /**
     * Sets the id of the document
     * @param $id
     * @return DocumentRequest
     */
    public function id($id)
    {
        $this->params['id'] = $id;

        return $this;
    }

    /**
     * Sets the index to operate on
     *
     * @param string        $index     indices to query
     * @param string        $index,... indices to query
     *
     * @return SearchRequest
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
     * Sets the type to operate on
     *
     * @param string        $type     types to query
     * @param string        $type,... types to query
     *
     * @return SearchRequest
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
     * Execute the search request on the ES cluster
     *
     * @throws \Elasticsearchphp\Exceptions\RuntimeException
     * @return \Elasticsearchphp\Responses\QueryResponse
     */
    public function execute()
    {

        $id = $this->params['id'];

        if (isset($this->params['index'])) {
            $index = implode(',', $this->params['index']);
        } else {
            $index = '';
        }

        if (isset($this->params['type'])) {
            $type = implode(',', $this->params['type']);
        } else {
            $type = '';
        }

        if (isset($queryParams)) {
            $queryParams = '?' . implode("&", $queryParams);
        } else {
            $queryParams = '';
        }


        $command = new \Elasticsearchphp\Requests\Command();
        $command->index($index)
            ->type($type)
            ->id($id . $queryParams)
            ->action('get');

        $this->batch->clearCommands();
        $this->batch->addCommand($command);

        $ret = parent::execute();

        return $ret[0];
    }

    /**
     * @param $response
     * @return \Elasticsearchphp\Responses\DocumentResponse|\Elasticsearchphp\Responses\Response
     */
    protected function getReturnResponse($response)
    {
        return new DocumentResponse($response);
    }
}