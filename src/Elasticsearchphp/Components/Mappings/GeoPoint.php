<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\GeoPoint field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\GeoPoint latitude() latitude(\float $value)
 * @method \Elasticsearchphp\Components\Mappings\GeoPoint longitude() longitude(\float $value)
 */
class GeoPoint extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
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

        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for Geo mapping");

        $ret = array($this->params['field'] => array('type' => 'geo_point'));

        return $ret;

    }

    public function getType()
    {
        return $this->type;
    }

}
