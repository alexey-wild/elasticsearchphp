<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\Ids type() type(\string $value)
 * @method Elasticsearchphp\Components\Queries\Ids values() values(array $value)
 */
class Ids extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'ids' =>
          array (
            'type' => $this->params["type"],
            'values' => $this->params["values"],
          ),
        );

        return $ret;
    }

}
