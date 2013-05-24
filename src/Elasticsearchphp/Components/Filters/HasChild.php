<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\HasChild type() type(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\HasChild query() query(\Elasticsearchphp\components\QueryInterface $value)
 */
class HasChild extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
            'has_child' =>
            array (
                'type' => $this->params["type"],
                'query' => $this->params["query"]->toArray(),
                //'_cache' => $this->params["_cache"],
            ),
        );

        return $ret;
    }

}
