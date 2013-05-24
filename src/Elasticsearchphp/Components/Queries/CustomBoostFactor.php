<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\CustomBoostFactor query() query(\Elasticsearchphp\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\CustomBoostFactor boost_factor() boost_factor(\float $value) Default: 3
 */
class CustomBoostFactor extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost_factor'] = 3;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'custom_boost_factor' =>
          array (
            'query' => $this->params["query"]->toArray(),
            'boost_factor' => $this->params["boost_factor"],
          ),
        );

        return $ret;
    }

}
