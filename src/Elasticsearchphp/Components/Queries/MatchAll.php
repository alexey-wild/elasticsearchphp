<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\MatchAll boost() boost(\float $value) Default: 1
 */
class MatchAll extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 1;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'match_all' =>
          array (
            'boost' => $this->params["boost"],
          ),
        );

        return $ret;
    }

}
