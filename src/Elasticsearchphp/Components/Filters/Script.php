<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Script script() script(\string $value)
 * @method Elasticsearchphp\Components\Filters\Script params() params(array $value) Default: array()
 * @method Elasticsearchphp\Components\Filters\Script _cache() _cache(\bool $value) Default: false
 */
class Script extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['params'] = array();
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
              'script' =>
              array (
                'script' => $this->params["script"],
                'params' => $this->params["params"],
                '_cache' => $this->params["_cache"],
              ),
            );

        return $ret;
    }

}
