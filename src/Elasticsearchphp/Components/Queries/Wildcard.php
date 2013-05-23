<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Wildcard field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Wildcard value() value(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Wildcard boost() boost(\float $value) Default: 1.0
 */
class Wildcard extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 1.0;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'wildcard' =>
          array (
            $this->params["field"] =>
            array (
              'value' => $this->params["value"],
              'boost' => $this->params["boost"],
            ),
          ),
        );

        return $ret;
    }

}
