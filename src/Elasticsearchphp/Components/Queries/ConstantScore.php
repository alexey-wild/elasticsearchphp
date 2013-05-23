<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\ConstantScore filter() filter(\sherlock\components\FilterInterface $value)
 * @method \Elasticsearchphp\Components\Queries\ConstantScore boost() boost(\float $value) Default: 1.2
 */
class ConstantScore extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 1.2;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'constant_score' =>
          array (
            'filter' => $this->params["filter"]->toArray(),
            'boost' => $this->params["boost"],
          ),
        );

        return $ret;
    }

}
