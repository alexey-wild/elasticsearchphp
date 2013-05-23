<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Bool must() must(array $value)
 * @method Elasticsearchphp\Components\Filters\Bool must_not() must_not(array $value)
 * @method Elasticsearchphp\Components\Filters\Bool should() should(array $value)
 * @method Elasticsearchphp\Components\Filters\Bool _cache() _cache(\bool $value) Default: false
 */
class Bool extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'bool' =>
          array (
            'must' => $this->params["must"],
            'must_not' => $this->params["must_not"],
            'should' => $this->params["should"],
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
