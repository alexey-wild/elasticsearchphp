<?php

namespace Elasticsearchphp\Wrappers;

use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\String String() String()
 * @method \Elasticsearchphp\Components\Mappings\Number Number() Number()
 * @method \Elasticsearchphp\Components\Mappings\Date Date() Date()
 * @method \Elasticsearchphp\Components\Mappings\Boolean Boolean() Boolean()
 * @method \Elasticsearchphp\Components\Mappings\Binary Binary() Binary()
 * @method \Elasticsearchphp\Components\Mappings\Object Object() Object()
 * @method \Elasticsearchphp\Components\Mappings\Analyzer Analyzer() Analyzer()
 */
class MappingPropertyWrapper
{
    /**
     * @var \Elasticsearchphp\Components\MappingInterface
     */
    protected $property;

    protected $type;

    /**
     * @param  string $type
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     */
    public function __construct($type)
    {
        if (!isset($type)) throw new Exceptions\BadResponseException("Type must be set for mapping property");

        $this->type = $type;

    }


    public function __call($name, $arguments)
    {
        $class = '\\Elasticsearchphp\\Components\\Mappings\\' . $name;

        //Type can be passed in the with constructor, used for multi-mappings on index creation
        //Argument[0] is an optional hashmap to define properties via an array
        if (count($arguments) > 0) $this->property = new $class($this->type, $arguments[0]);
        else $this->property = new $class($this->type);

        return $this->property;
    }

}
