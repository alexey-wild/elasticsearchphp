<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\FilteredQuery query() query(\Elasticsearchphp\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\FilteredQuery filter() filter(\Elasticsearchphp\components\FilterInterface $value)
 */
class FilteredQuery extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'filtered' =>
          array (
            'query' => $this->params["query"]->toArray(),
            'filter' => $this->params["filter"],
          ),
        );

        return $ret;
    }

}
