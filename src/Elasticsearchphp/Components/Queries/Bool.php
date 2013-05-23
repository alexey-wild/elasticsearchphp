<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\Bool minimum_number_should_match() minimum_number_should_match(\int $value) Default: 2
 * @method Elasticsearchphp\Components\Queries\Bool boost() boost(\float $value) Default: 1.0
 * @method Elasticsearchphp\Components\Queries\Bool disable_coord() disable_coord(\int $value) Default: 1
 */
class Bool extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['must'] = array();
        $this->params['must_not'] = array();
        $this->params['should'] = array();
        $this->params['minimum_number_should_match'] = 2;
        $this->params['boost'] = 1.0;
        $this->params['disable_coord'] = 1;

        parent::__construct($hashMap);
    }

    public function must($value)
    {
        $args = func_get_args();

        if (count($args) == 1)$args = $args[0];

        foreach ($args as $arg) if ($arg instanceof Elasticsearchphp\Components\QueryInterface) $this->params['must'][] = $arg->toArray();

        return $this;
    }

    public function must_not($value)
    {
        $args = func_get_args();

        if (count($args) == 1) $args = $args[0];

        foreach ($args as $arg) if ($arg instanceof Elasticsearchphp\Components\QueryInterface) $this->params['must_not'][] = $arg->toArray();

        return $this;
    }

    public function should($value)
    {
        $args = func_get_args();

        if (count($args) == 1) $args = $args[0];

        foreach ($args as $arg) if ($arg instanceof Elasticsearchphp\Components\QueryInterface) $this->params['should'][] = $arg->toArray();

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $ret = array (
          'bool' =>
          array (
            'must' => $this->params["must"],
            'must_not' => $this->params["must_not"],
            'should' => $this->params["should"],
            'minimum_number_should_match' => $this->params["minimum_number_should_match"],
            'boost' => $this->params["boost"],
            'disable_coord' => $this->params["disable_coord"],
          ),
        );

        return $ret;
    }

}
