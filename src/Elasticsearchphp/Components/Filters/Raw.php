<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method  \Elasticsearchphp\Components\Filters\Raw Raw() Raw(\string $json)
 */
class Raw extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    /**
     * @param array|string $hashMap
     * @throws Exceptions\BadResponseException
     */
    public function __construct($hashMap)
    {
        if (!isset($hashMap)) throw new Exceptions\BadResponseException("Hashmap must be provided for the Raw filter");

        //Raw array hash map provided
        //put it right into the params
        if (is_array(($hashMap)) && count($hashMap) > 0) $this->params['hash'] = $hashMap;
        //Raw JSON has been provided
        //Decode from JSON into array
        elseif (is_string($hashMap)) $this->params['hash'] = json_decode($hashMap, true);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->params['hash'];
    }
}
