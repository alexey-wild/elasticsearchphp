<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\HasParent parent_type() parent_type(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\HasParent query() query(\Elasticsearchphp\components\QueryInterface $value)
 */
class HasParent extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
            'has_parent' =>
            array (
                'parent_type' => $this->params["parent_type"],
                'query' => $this->params["query"]->toArray(),
                //'_cache' => $this->params["_cache"],
            ),
        );

        return $ret;
    }

}
