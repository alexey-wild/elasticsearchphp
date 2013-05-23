<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Missing field() field(\string $value)
 * @method Elasticsearchphp\Components\Filters\Missing existence() existence(\bool $value) Default: true
 * @method Elasticsearchphp\Components\Filters\Missing null_value() null_value(\bool $value) Default: false
 */
class Missing extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['existence'] = true;
        $this->params['null_value'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'missing' =>
          array (
            'field' => $this->params["field"],
            'existence' => $this->params["existence"],
            'null_value' => $this->params["null_value"],
          ),
        );
        
        return $ret;
    }

}
