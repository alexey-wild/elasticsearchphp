<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;
use Elasticsearchphp\Exceptions;

/**
 * @method Elasticsearchphp\Components\Queries\Raw Raw() Raw(\string $json)
 */
class Raw extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap)
    {
        if (!isset($hashMap)) throw new \Elasticsearchphp\Exceptions\BadResponseException("Hashmap must be provided for the Raw query");

        //Raw array hash map provided
        //put it right into the params
        if (is_array(($hashMap)) && count($hashMap) > 0) $this->params['hash'] = $hashMap;
        //Raw JSON has been provided
        //Decode from JSON into array
        elseif (is_string($hashMap)) $this->params['hash'] = json_decode($hashMap, true);

    }

    public function toArray()
    {
        return $this->params['hash'];
    }
}
