<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Nested path() path(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Nested score_mode() score_mode(\string $value) Default: "avg"
 * @method \Elasticsearchphp\Components\Queries\Nested query() query(\Elasticsearchphp\components\QueryInterface $value)
 */
class Nested extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['score_mode'] = "avg";

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'nested' =>
          array (
            'path' => $this->params["path"],
            'score_mode' => $this->params["score_mode"],
            'query' => $this->params["query"]->toArray(),
          ),
        );

        return $ret;
    }

}
