<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\OrFilter _cache() _cache(\bool $value) Default: false
 */
class OrFilter extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = null;

        parent::__construct($hashMap);
    }

    /**
     * @param  \Elasticsearchphp\Components\QueryInterface | \Elasticsearchphp\Components\QueryInterface | array $values,... - one or more Queries can be specified individually, or an array of filters
     * @return OrFilter
     */
    public function queries($values)
    {
        $args = func_get_args();

        //single param, array of queries\filters
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) {
            if ($arg instanceof \Elasticsearchphp\Components\QueryInterface) $this->params['queries'][] = $arg->toArray();
            elseif ($arg instanceof \Elasticsearchphp\Components\FilterInterface) $this->params['queries'][] = $arg->toArray();
        }

        //was this a set of filters?  Assume it was if the first arg is a filter
        if ($args[0] instanceof \Elasticsearchphp\Components\FilterInterface) $this->params['queries'] = array("filters" => $this->params['queries']);

        return $this;
    }

    public function toArray()
    {
        $ret = array (
          'or' => $this->params["queries"],
        );
        if ($this->params["_cache"]) $ret['_cache'] =  $this->params["_cache"];

        return $ret;
    }

}
