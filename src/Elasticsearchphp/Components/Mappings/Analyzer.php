<?php

namespace Elasticsearchphp\Components\Mappings;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method \Elasticsearchphp\Components\Mappings\Analyzer path() path(\string $value)
 * @method \Elasticsearchphp\Components\Mappings\Analyzer index() index(\bool $value)
 *
 */
class Analyzer extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\MappingInterface
{
    
    protected $type;

    /**
     * @param null $type
     * @param null $hashMap
     */
    public function __construct($type = null, $hashMap = null)
    {
        //if $type is set, we need to wrap the mapping property in a type
        //this is used for multi-mappings on index creation
        if (isset($type)) $this->type = $type;

        $this->params['path']  = null;
        $this->params['index'] = null;

        parent::__construct($hashMap);
    }

    /**
     * @return array
     * @throws \RuntimeException
     */
    public function toArray()
    {
        $ret = array();

        if (!isset($this->params['path'])) throw new \RuntimeException("Path must be set for Analyzer mapping");

        $ret['_analyzer']['path'] = $this->params['path'];

        if (isset($this->params['index'])) $ret['_analyzer']['index'] = $this->params['index'];

        return $ret;

    }

    /**
     * @return null
     */
    public function getType()
    {
        return $this->type;
    }

}