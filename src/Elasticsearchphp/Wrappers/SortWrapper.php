<?php

namespace Elasticsearchphp\Wrappers;

use Elasticsearchphp\Components\Sorts;

/**
 * @method \Elasticsearchphp\Components\Sorts\Field Field() Field()
 */
class SortWrapper
{
    /**
     * @var \Elasticsearchphp\Components\SortInterface
     */
    protected $query;

    /**
     * @param $name
     * @param $arguments
     * @return \Elasticsearchphp\Components\SortInterface
     */
    public function __call($name, $arguments)
    {
        $class = '\\Elasticsearchphp\\Components\\Sorts\\'.$name;

        if (count($arguments) > 0) $this->query =  new $class($arguments[0]);
        else $this->query =  new $class();

        return $this->query;
    }

    public function __toString()
    {
        return (string) $this->query;
    }

}
