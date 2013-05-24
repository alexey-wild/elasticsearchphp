<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Limit value() value(\int $value)
 */
class Limit extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'limit' =>
          array (
            'value' => $this->params["value"],
          ),
        );

        return $ret;
    }

}
