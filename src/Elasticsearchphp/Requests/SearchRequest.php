<?php

namespace Elasticsearchphp\Requests;

use Elasticsearchphp\Exceptions;
use Elasticsearchphp\Components;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * SearchRequest facilitates searching an ES index using the ES query DSL
 *
 * @method \Elasticsearchphp\Requests\SearchRequest timeout() timeout(\int $value)
 * @method \Elasticsearchphp\Requests\SearchRequest from() from(\int $value)
 * @method \Elasticsearchphp\Requests\SearchRequest size() size(\int $value)
 * @method \Elasticsearchphp\Requests\SearchRequest search_type() search_type(\int $value)
 * @method \Elasticsearchphp\Requests\SearchRequest routing() routing(mixed $value)
 */
class SearchRequest extends Request
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var \Symfony\Component\EventDispatcher\EventDispatcher
     */
    protected $dispatcher;

    public function __construct($dispatcher)
    {
        if (!isset($dispatcher)) throw new Exceptions\BadResponseException("Dispatcher argument required for IndexRequest");

        $this->params['filter'] = array();
        $this->dispatcher = $dispatcher;

        parent::__construct($dispatcher);
    }

    /**
     * @param $name
     * @param $args
     * @return SearchRequest
     */
    public function __call($name, $args)
    {
        $this->params[$name] = $args[0];

        return $this;
    }

    /**
     * Sets the index to operate on
     *
     * @param  string        $index     indices to query
     * @param  string        $index,... indices to query
     * @return SearchRequest
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
     * Sets the type to operate on
     *
     * @param  string        $type     types to query
     * @param  string        $type,... types to query
     * @return SearchRequest
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
     * Sets the query that will be executed
     *
     * @param $query
     * @return SearchRequest
     */
    public function query($query)
    {
        $this->params['query'] = $query;

        return $this;
    }

    /**
     * Sets the query or queries that will be executed
     *
     * @param  \Elasticsearchphp\Сomponents\SortInterface|array,... $value
     * @return SearchRequest
     */
    public function sort($value)
    {
        $args = func_get_args();

        //single param, array of sorts
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) {
            if ($arg instanceof Components\SortInterface) $this->params['sort'][] = $arg->toArray();
        }

        return $this;
    }

    /**
     * Sets the filter that will be executed
     *
     * @param $filter
     * @return SearchRequest
     */
    public function filter($filter)
    {
        $this->params['filter'] = $filter;

        return $this;
    }

    /**
     * Sets the analyzer that will be executed
     *
     * @param $analyzer
     * @return SearchRequest
     */
    public function analyzer($analyzer)
    {
        $this->params['analyzer'] = $analyzer;

        return $this;
    }

    /**
     * Execute the search request on the ES cluster
     *
     * @throws \Sherlock\common\exceptions\RuntimeException
     * @return \Sherlock\responses\QueryResponse
     */
    public function execute()
    {
        $finalQuery = $this->composeFinalQuery();

        if (isset($this->params['index'])) $index = implode(',', $this->params['index']);
        else $index = '';

        if (isset($this->params['type'])) $type = implode(',', $this->params['type']);
        else $type = '';

        if (isset($this->params['search_type'])) $queryParams[] = $this->params['search_type'];

        if (isset($this->params['routing'])) $queryParams[] = $this->params['routing'];

//        if (isset($this->params['analyzer'])) $queryParams[] = $this->params['analyzer'];

        if (isset($queryParams)) $queryParams = '?' . implode("&", $queryParams);
        else $queryParams = '';


        $command = new Command();
        $command->index($index)
                ->type($type)
                ->id('_search'.$queryParams)
                ->action('post')
                ->data($finalQuery);

        $this->batch->clearCommands();
        $this->batch->addCommand($command);

        $ret =  parent::execute();

        return $ret[0];
    }

    /**
     * Return a JSON representation of the final search request
     *
     * @return string
     */
    public function toJSON()
    {
        $finalQuery = $this->composeFinalQuery();

        return $finalQuery;
    }

    /**
     * Composes the final query, aggregating together the queries, filters, facets and associated parameters
     *
     * @return string
     * @throws \RuntimeException
     */
    private function composeFinalQuery()
    {
        $finalQuery = array();

        if (isset($this->params['query']) && $this->params['query'] instanceof Components\QueryInterface) $finalQuery['query'] = $this->params['query']->toArray();
        if (isset($this->params['filter']) && $this->params['filter'] instanceof Components\FilterInterface) $finalQuery['filter'] = $this->params['filter']->toArray();
        if (isset($this->params['analyzer']) && $this->params['analyzer'] instanceof Components\MappingInterface) $finalQuery['analyzer'] = $this->params['analyzer']->toArray();

        foreach (array('from', 'size', 'timeout', 'sort') as $key) if (isset($this->params[$key])) $finalQuery[$key] = $this->params[$key];

        $finalQuery = json_encode($finalQuery, true);

        return $finalQuery;
    }

}
