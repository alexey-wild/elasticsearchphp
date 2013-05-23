<?php

namespace Elasticsearchphp\Components;

/**
 * BaseComponent is an abstract class for various components (filters, queries, sort)
 *
 * BaseComponent is used to enforce the toJSON() and toArray() functions in children classes,
 * as well as provide a unified logger for all components.  It also manages hashmap initialization
 * on construction.  Lastly, it provides a convenient type when you know a variable will be a
 * query/filter/sort...but not sure which until runtime
 */
abstract class BaseComponent
{
    /**
     * @var array Parameters of the component, varies depending on the child class
     */
    protected $params = array();

    /**
     * @param array $hashMap Optional hashmap parameter, accepts an associative array to set parameters manually
     */
    public function __construct($hashMap = null)
    {
        if (is_array(($hashMap)) && count($hashMap) > 0)
            //merge the provided values with our param array, overwriting defaults where necessary
            $this->params = array_merge($this->params, $hashMap);
    }

    /**
     * Magic method, primary setter of the components.
     *
     * Most components in Elasticsearchphp use magic methods to set values, returning itself
     * so that methods can be chained.  In most cases, the method simply sets a parameter
     * of it's own name, but sometimes is overridden by the child class. toJSON is a special
     * method call that is only found in BaseComponent
     *
     * @param $name
     * @param $arguments
     * @return BaseComponent|string
     */
    public function __call($name, $arguments)
    {
        if ($name == 'toJSON') return $this->toJSON();

        $this->params[$name] = $arguments[0];

        return $this;
    }

    /**
     * Return a JSON representation of this component
     *
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this->toArray());
    }

    /**
     * Return an associative array representation of this component
     *
     * @return array
     */
    abstract public function toArray();

}
