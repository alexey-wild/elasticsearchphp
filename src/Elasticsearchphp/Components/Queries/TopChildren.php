<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\TopChildren type() type(\string $value)
 * @method Elasticsearchphp\Components\Queries\TopChildren query() query(\sherlock\components\QueryInterface $value)
 * @method Elasticsearchphp\Components\Queries\TopChildren score() score(\string $value) Default: "max"
 * @method Elasticsearchphp\Components\Queries\TopChildren factor() factor(\int $value) Default: 5
 * @method Elasticsearchphp\Components\Queries\TopChildren incremental_factor() incremental_factor(\int $value) Default: 5
 */
class TopChildren extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['score'] = "max";
        $this->params['factor'] = 5;
        $this->params['incremental_factor'] = 5;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'top_children' =>
          array (
            'type' => $this->params["type"],
            'query' => $this->params["query"]->toArray(),
            'score' => $this->params["score"],
            'factor' => $this->params["factor"],
            'incremental_factor' => $this->params["incremental_factor"],
          ),
        );

        return $ret;
    }

}
