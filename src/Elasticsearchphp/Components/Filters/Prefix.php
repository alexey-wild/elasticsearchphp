<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Prefix field() field(\string $value)
 * @method Elasticsearchphp\Components\Filters\Prefix prefix() prefix(\string $value)
 * @method Elasticsearchphp\Components\Filters\Prefix _cache() _cache(\bool $value) Default: true
 */
class Prefix extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = true;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
              'prefix' =>
              array (
                $this->params["field"] => $this->params["prefix"],
                '_cache' => $this->params["_cache"],
              ),
            );

        return $ret;
    }

}
