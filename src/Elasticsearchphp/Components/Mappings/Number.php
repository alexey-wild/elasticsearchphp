<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\Number field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number store() store(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number index() index(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number index_name() index_name(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number boost() boost(\float $value)
 * @method \Elasticsearchphp\Components\Mappings\Number null_value() null_value(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number type() type(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number precision_step() precision_step(\int $value)
 * @method \Elasticsearchphp\Components\Mappings\Number include_in_all() include_in_all(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Number ignore_malformed() ignore_malformed(\bool $value)
 */
class Number extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field') continue;
            $ret[$key] = $value;
        }

        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for Number mapping");
        if (!isset($this->params['type'])) throw new \RuntimeException("Field type must be set for Number mapping");

        $ret = array($this->params['field'] => $ret);

        //if (isset($this->type))
        //	$ret = array($this->type => array("properties" => $ret));
        return $ret;

    }

    public function getType()
    {
        return $this->type;
    }

}
