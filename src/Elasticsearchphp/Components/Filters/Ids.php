<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Ids type() type(\string $value)
 */
class Ids extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    /**
     * @param  \string | array $values
     * @return Ids
     */
    public function values($ids)
    {
        $args = func_get_args();

        //single param, array of ids
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) if (is_string($arg)) $this->params['values'][] = $arg;

        return $this;
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
