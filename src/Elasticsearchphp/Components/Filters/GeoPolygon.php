<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\GeoPolygon points() points(array $value)
 * @method Elasticsearchphp\Components\Filters\GeoPolygon _cache() _cache(\bool $value) Default: false
 */
class GeoPolygon extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'geo_polygon' =>
          array (
            'person.location' =>
            array (
              'points' => $this->params["points"],
            ),
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
