<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Not _cache() _cache(\bool $value) Default: false
 */
class Not extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;
        $this->params['not'] = null;

        parent::__construct($hashMap);
    }

    /**
     * @param  Elasticsearchphp\Components\QueryInterface | Elasticsearchphp\Components\FilterInterface $value
     * @return Not
     */
    public function not($value)
    {
        if ($value instanceof \Elasticsearchphp\Components\QueryInterface) $this->params['not'] = $value->toArray();
        elseif ($value instanceof \Elasticsearchphp\Components\FilterInterface) $this->params['not'] = array("filter" => $value->toArray());

        return $this;
    }

    public function toArray()
    {
        $ret = array (
          'not' => $this->params["not"],
          '_cache' => $this->params["_cache"],
        );

        return $ret;
    }

}
