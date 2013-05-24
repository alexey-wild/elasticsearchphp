<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Nested path() path(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\Nested query() query(\Elasticsearchphp\components\QueryInterface $value)
 * @method  \Elasticsearchphp\Components\Filters\Nested _cache() _cache(\bool $value) Default: false
 */
class Nested extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'nested' =>
          array (
            'path' => $this->params["path"],
            'query' => $this->params["query"],
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
