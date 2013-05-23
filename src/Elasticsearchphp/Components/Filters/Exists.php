<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Exists field() field(\string $value)
 */
class Exists extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'exists' =>
          array (
            'field' => $this->params["field"],
          ),
        );

        return $ret;
    }

}
