<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Type value() value(\string $value)
 */
class Type extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'type' =>
          array (
            'value' => $this->params["value"]
            )
          );

        return $ret;
    }

}
