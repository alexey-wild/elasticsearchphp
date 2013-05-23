<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\AndFilter and() and(array $value)
 * @method Elasticsearchphp\Components\Filters\AndFilter _cache() _cache(\bool $value) Default: false
 */
class AndFilter extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'and' => $this->params["and"],
          '_cache' => $this->params["_cache"],
        );

        return $ret;
    }

}
