<?php

namespace Elasticsearchphp\Requests;

use Elasticsearchphp\Exceptions;
use Elasticsearchphp\Components;
use Elasticsearchphp\Wrappers;

/**
 * IndexRequest manages index-specific operations
 *
 * Index operations include actions like getting or updating mappings,
 * creating new indices, deleting old indices, state, stats, etc
 *
 * Note, this is distinct from the IndexDocument class, which is solely responsible
 * for indexing documents
 */
class IndexRequest extends Request
{

    protected $dispatcher;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param \Symfony\Component\EventDispatcher\EventDispatcher $dispatcher
     * @param $index
     *
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     * @internal param $node
     */
    public function __construct($dispatcher, $index)
    {
        if (!isset($dispatcher)) throw new Exceptions\BadResponseException("Dispatcher argument required for IndexRequest");
        if (!isset($index)) throw new Exceptions\BadResponseException("Index argument required for IndexRequest");

        $this->dispatcher = $dispatcher;

        if (!is_array($index)) $this->params['index'][] = $index;
        else $this->params['index'] = $index;

        $this->params['indexSettings'] = array();
        $this->params['indexMappings'] = array();

        parent::__construct($dispatcher);
    }


    /**
     * @param $name
     * @param $args
     *
     * @return IndexRequest
     */
    public function __call($name, $args)
    {
        $this->params[$name] = $args[0];

        return $this;
    }


    /**
     * ---- Settings / Parameters ----
     * Various settings and parameters to be set before invoking an action
     * Returns $this
     *
     */

    /**
     * Set the index to operate on
     *
     * @param  string       $index     indices to operate on
     * @param  string       $index,... indices to operate on
     *
     * @return IndexRequest
     */
    public function index($index)
    {
        $this->params['index'] = array();

        $args = func_get_args();

        foreach ($args as $arg) {
            $this->params['index'][] = $arg;
        }

        return $this;
    }


    /**
     * Set the type to operate on
     *
     * @param  string       $type     indices to operate on
     * @param  string       $type,... indices to operate on
     *
     * @return IndexRequest
     */
    public function type($type)
    {
        $this->params['type'] = array();

        $args = func_get_args();

        foreach ($args as $arg) {
            $this->params['type'][] = $arg;
        }

        return $this;
    }


    /**
     * Set the mappings that are used for various operations (set mappings, index creation, etc)
     *
     * @todo fix array-only input
     * @todo add json input
     *
     * @param  array|\Elasticsearchphp\Components\MappingInterface|bool   $mapping,...
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     * @return \Elasticsearchphp\Requests\IndexRequest
     */
    public function mappings($mapping)
    {
        $args = func_get_args();


        //@todo this is all horrible, burn it and rewrite

        foreach ($args as $arg) {

            if ($arg instanceof Components\MappingInterface) {

                //is this a core type?  Wrap in 'properties'
                if (!($arg instanceof Components\Mappings\Analyzer)) $mappingValue = array("properties" => $arg->toArray());
                else $mappingValue = $arg->toArray();

                if (isset($this->params['indexMappings'][$arg->getType()])) $this->params['indexMappings'][$arg->getType()] = array_merge_recursive($this->params['indexMappings'][$arg->getType()],$mappingValue);
                else $this->params['indexMappings'][$arg->getType()] = $mappingValue;
            } elseif (is_array($arg)) {
                foreach ($arg as $argMapping) {

                    //is this a core type?  Wrap in 'properties'
                    if (!($arg instanceof Components\Mappings\Analyzer)) $mappingValue = array("properties" => $argMapping->toArray());
                    else $mappingValue = $argMapping->toArray();

                    if (isset($this->params['indexMappings'][$argMapping->getType()])) $this->params['indexMappings'][$argMapping->getType()] = array_merge_recursive($this->params['indexMappings'][$argMapping->getType()],$mappingValue);
                    else $this->params['indexMappings'][$argMapping->getType()] = $mappingValue;
                }
            } else {
                throw new Exceptions\BadResponseException("Arguments must be an array or a Mapping Property.");
            }

        }

        return $this;
    }


    /**
     * Set the index settings, used predominantly for index creation
     *
     * @param  array|\Elasticsearchphp\Wrappers\IndexSettingsWrapper      $settings
     * @param  bool                                               $merge
     *
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     * @return IndexRequest
     */
    public function settings($settings, $merge = true)
    {
        if ($settings instanceof Wrappers\IndexSettingsWrapper) $newSettings = $settings->toArray();
        elseif (is_array($settings)) $newSettings = $settings;
        else throw new Exceptions\BadResponseException("Unknown parameter provided to settings(). Must be array of settings or IndexSettingsWrapper.");

        if ($merge) $this->params['indexSettings'] = array_merge($this->params['indexSettings'], $newSettings);
        else $this->params['indexSettings'] = $newSettings;

        return $this;
    }


    /**
     * Update the settings of an index
     *
     * @todo allow updating settings of all indices
     *
     * @return \Elasticsearchphp\Responses\IndexResponse
     * @throws \RuntimeException
     */
    public function updateSettings()
    {
        if (!isset($this->params['index'])) throw new \RuntimeException("Index cannot be empty.");

        $index = implode(',', $this->params['index']);

        $body = array("index" => $this->params['indexSettings']);

        $command = new Command();
        $command->index($index)
            ->id('_settings')
            ->action('put')
            ->data(json_encode($body, JSON_FORCE_OBJECT));

        $this->batch->clearCommands();
        $this->batch->addCommand($command);

        $ret = parent::execute();

        //clear out mappings, settings
        //$this->resetIndex();

        return $ret[0];

    }


    /**
     * Update/add the Mapping of an index
     *
     * @return \Elasticsearchphp\Responses\IndexResponse
     * @throws \RuntimeException
     */
    public function updateMapping()
    {
        if (!isset($this->params['index'])) throw new Exceptions\RuntimeException("Index cannot be empty.");

        if (count($this->params['indexMappings']) > 1) throw new Exceptions\RuntimeException("May only update one mapping at a time.");

        if (!isset($this->params['type'])) throw new Exceptions\RuntimeException("Type must be specified.");

        if (count($this->params['type']) > 1) throw new Exceptions\RuntimeException("Only one type may be updated at a time.");

        $index = implode(',', $this->params['index']);
        $body  = $this->params['indexMappings'];

        $command = new Command();
        $command->index($index)
            ->type($this->params['type'][0])
            ->id('_mapping')
            ->action('put')
            ->data(json_encode($body, JSON_FORCE_OBJECT));

        $this->batch->clearCommands();
        $this->batch->addCommand($command);

        $ret = parent::execute();

        //clear out mappings, settings
        //$this->resetIndex();

        return $ret[0];
    }

    private function resetIndex()
    {
        $this->params['indexMappings'] = array();
        $this->params['indexSettings'] = array();
    }
}