<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\Object field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Object enabled() enabled(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\Object path() path(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Object dynamic() dynamic(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\Object include_in_all() include_in_all(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\Object object() object(\Elasticsearchphp\components\MappingInterface $value)
 */
class Object extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        $this->params['type'] = 'object';
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array();
        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for Object mapping");
        if (!isset($this->params['object'])) throw new \RuntimeException("Object parameter must be set for Object mapping");

        $object = $this->params['object']->toArray();

        $extra = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field' || $key == 'object') continue;
            $extra[$key] = $value;
        }

        $ret = array($this->params['field'] => array_merge(array("properties" => $object), $extra));

        //if (isset($this->type))
        //	$ret = array($this->type => array("properties" => $ret));
        return $ret;

    }

    public function getType()
    {
        return $this->type;
    }

}
