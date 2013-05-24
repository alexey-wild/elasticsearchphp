<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\HasParent parent_type() parent_type(\string $value)
 * @method \Elasticsearchphp\Components\Queries\HasParent score_type() score_type(\string $value) Default: "score"
 * @method \Elasticsearchphp\Components\Queries\HasParent query() query(\Elasticsearchphp\components\QueryInterface $value)
 */
class HasParent extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['score_type'] = "score";

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'has_parent' =>
          array (
            'parent_type' => $this->params["parent_type"],
            'score_type' => $this->params["score_type"],
            'query' => $this->params["query"]->toArray(),
          ),
        );

        return $ret;
    }

}
