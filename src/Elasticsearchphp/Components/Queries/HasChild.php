<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\HasChild type() type(\string $value)
 * @method \Elasticsearchphp\Components\Queries\HasChild score_type() score_type(\string $value) Default: "sum"
 * @method \Elasticsearchphp\Components\Queries\HasChild query() query(\Elasticsearchphp\components\QueryInterface $value)
 */
class HasChild extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['score_type'] = "sum";

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'has_child' =>
          array (
            'type' => $this->params["type"],
            'score_type' => $this->params["score_type"],
            'query' => $this->params["query"]->toArray(),
          ),
        );

        return $ret;
    }

}
