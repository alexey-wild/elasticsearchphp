<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

class MatchAll extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
      parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'match_all' =>
          array (
          ),
        );

        return $ret;
    }

}
