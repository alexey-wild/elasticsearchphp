<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Prefix field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Prefix value() value(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Prefix boost() boost(\float $value) Default: 2.0
 * @method \Elasticsearchphp\Components\Queries\Prefix analyzer() analyzer(\string $value) Default: "default"
 * @method \Elasticsearchphp\Components\Queries\Prefix slop() slop(\int $value) Default: 3
 * @method \Elasticsearchphp\Components\Queries\Prefix max_expansions() max_expansions(\int $value) Default: 100
 */
class Prefix extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 2.0;
        $this->params['analyzer'] = "default";
        $this->params['slop'] = 3;
        $this->params['max_expansions'] = 100;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'prefix' =>
          array (
            $this->params["field"] =>
            array (
              'value' => $this->params["value"],
              'boost' => $this->params["boost"],
              'analyzer' => $this->params["analyzer"],
              'slop' => $this->params["slop"],
              'max_expansions' => $this->params["max_expansions"],
            ),
          ),
        );

        return $ret;
    }

}
