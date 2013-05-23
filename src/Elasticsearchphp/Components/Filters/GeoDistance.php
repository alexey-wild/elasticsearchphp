<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\GeoDistance distance() distance(\string $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistance lat() lat(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistance lon() lon(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistance _cache() _cache(\bool $value) Default: false
 */
class GeoDistance extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'geo_distance' =>
          array (
            'distance' => $this->params["distance"],
            'pin.location' =>
            array (
              'lat' => $this->params["lat"],
              'lon' => $this->params["lon"],
            ),
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
