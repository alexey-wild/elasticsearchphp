<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\String field() field(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String store() store(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String index() index(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\STring index_name() index_name(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String term_vector() term_vector(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String boost() boost(\float $value)
 * @method \Elasticsearchphp\Components\Mappings\String null_value() null_value(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String omit_norms() omit_norms(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\String omit_term_freq_and_positions() omit_term_freq_and_positions(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\String index_options() index_options(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String analyzer() analyzer(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String index_analyzer() index_analyzer(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String search_analyzer() search_analyzer(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\String include_in_all() include_in_all(\bool $value)
 * @method \Elasticsearchphp\Components\Mappings\String ignore_above() ignore_above(\int $value)
 * @method \Elasticsearchphp\Components\Mappings\String position_offset_gap() position_offset_gap(\int $value)
 *
 *
 */
class String extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        $this->params['type'] = 'string';
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array();
        foreach ($this->params as $key => $value) {
            if ($key == 'field') continue;
            $ret[$key] = $value;
        }

        if (!isset($this->params['field'])) throw new \RuntimeException("Field name must be set for String mapping");

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
