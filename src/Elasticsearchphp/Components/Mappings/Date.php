<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\Date field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date store() store(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date index() index(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date index_name() index_name(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date format() format(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date boost() boost(\float $value)
 * @method \Elasticsearchphp\Components\Mappings\Date null_value() null_value(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Date precision_step() precision_step(\int $value)
 * @method \Elasticsearchphp\Components\Mappings\Date include_in_all() include_in_all(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\Date ignore_malformed() ignore_malformed(\bool $value)
 *
 *
 */
class Date extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        $this->params['type'] = 'date';
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field') continue;
            $ret[$key] = $value;
        }

        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for Date mapping");

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
