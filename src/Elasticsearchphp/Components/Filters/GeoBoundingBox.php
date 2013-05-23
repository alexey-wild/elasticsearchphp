<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox top_left_lat() top_left_lat(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox top_left_lon() top_left_lon(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox bottom_right_lat() bottom_right_lat(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox bottom_right_lon() bottom_right_lon(\float $value)
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox type() type(\string $value) Default: "memory"
 * @method Elasticsearchphp\Components\Filters\GeoBoundingBox _cache() _cache(\bool $value) Default: false
 */
class GeoBoundingBox extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['type'] = "memory";
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'geo_bounding_box' =>
          array (
            'pin.location' =>
            array (
              'top_left' =>
              array (
                'lat' => $this->params["top_left_lat"],
                'lon' => $this->params["top_left_lon"],
              ),
              'bottom_right' =>
              array (
                'lat' => $this->params["bottom_right_lat"],
                'lon' => $this->params["bottom_right_lon"],
              ),
            ),
            'type' => $this->params["type"],
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
