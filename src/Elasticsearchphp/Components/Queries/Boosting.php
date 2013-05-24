<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Boosting positive() positive(\Elasticsearchphp\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\Boosting negative() negative(\Elasticsearchphp\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\Boosting negative_boost() negative_boost(\float $value) Default: 0.2
 */
class Boosting extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['negative_boost'] = 0.2;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'boosting' =>
          array (
            'positive' => $this->params["positive"]->toArray(),
            'negative' => $this->params["negative"]->toArray(),
            'negative_boost' => $this->params["negative_boost"],
          )
        );

        return $ret;
    }

}
