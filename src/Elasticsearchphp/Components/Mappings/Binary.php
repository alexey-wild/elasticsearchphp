<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\Boolean field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Boolean index_name() index_name(\string $value)
 *
 */
class Binary extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        $this->params['type'] = 'binary';
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field') continue;
            $ret[$key] = $value;
        }

        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for Binary mapping");

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
