<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Сomponents;

/**
 * @method Elasticsearchphp\Components\Filters\GeoDistanceRange from() from(\string $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistanceRange to() to(\string $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistanceRange lat() lat(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistanceRange lon() lon(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoDistanceRange _cache() _cache(\bool $value) Default: false
 */
class GeoDistanceRange extends \Elasticsearchphp\Сomponents\BaseComponent implements \Elasticsearchphp\Сomponents\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
            'geo_distance_range' =>
            array (
                'from' => $this->params["from"],
                'to' => $this->params["to"],
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
