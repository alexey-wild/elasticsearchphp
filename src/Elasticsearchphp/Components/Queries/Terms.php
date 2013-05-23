<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\Terms field() field(\string $value)
 * @method Elasticsearchphp\Components\Queries\Terms minimum_match() minimum_match(\int $value) Default: 2
 */
class Terms extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['minimum_match'] = 2;

        parent::__construct($hashMap);
    }

    /**
     * @param  \string | array $terms,...
     * @return Terms
     */
    public function terms($terms)
    {

        $args = func_get_args();

        //single param, array of filters
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) if (is_string($arg)) $this->params['terms'][] = $arg;

        return $this;
    }

    public function toArray()
    {
        $ret = array (
          'terms' =>
          array (
              $this->params["field"] => $this->params["terms"],
              'minimum_match' => $this->params["minimum_match"],

          ),
        );

        return $ret;
    }

}
