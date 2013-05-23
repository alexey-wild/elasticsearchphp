<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Query query() query(\sherlock\components\QueryInterface $value)
 * @method Elasticsearchphp\Components\Filters\Query _cache() _cache(\bool $value) Default: false
 */
class Query extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
              'query' => $this->params["query"]->toArray(),
              '_cache' => $this->params["_cache"],
            );

        return $ret;
    }

}
