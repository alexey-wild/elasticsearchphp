<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\DisMax tie_breaker() tie_breaker(\float $value) Default: 0.5
 * @method \Elasticsearchphp\Components\Queries\DisMax boost() boost(\float $value) Default: 2
 */
class DisMax extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['tie_breaker'] = 0.5;
        $this->params['boost'] = 2;

        parent::__construct($hashMap);
    }

    /**
     * @param  \Elasticsearchphp\Components\QueryInterface | array $queries,... - one or more Queries can be specified individually, or an array of filters
     * @return DisMax
     */
    public function queries($queries)
    {

        $args = func_get_args();

        //single param, array of filters
        if (count($args) == 1 && is_array($args[0]))$args = $args[0];

        foreach ($args as $arg) if ($arg instanceof \Elasticsearchphp\Components\QueryInterface) $this->params['queries'][] = $arg->toArray();

        return $this;
    }

    public function toArray()
    {
        $ret = array (
          'dis_max' =>
          array (
            'tie_breaker' => $this->params["tie_breaker"],
            'boost' => $this->params["boost"],
            'queries' => $this->params['queries'],
          ),
        );

        return $ret;
    }

}
