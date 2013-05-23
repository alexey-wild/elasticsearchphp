<?php

namespace Elasticsearchphp\Wrappers;

use Elasticsearchphp\Components\Filters;

/**
 * @method \Elasticsearchphp\Components\Filters\Bool Bool() Bool()
 * @method \Elasticsearchphp\Components\Filters\AndFilter AndFilter() AndFilter()
 * @method \Elasticsearchphp\Components\Filters\Exists Exists() Exists()
 * @method \Elasticsearchphp\Components\Filters\GeoBoundingBox GeoBoundingBox() GeoBoundingBox()
 * @method \Elasticsearchphp\Components\Filters\GeoDistance GeoDistance() GeoDistance()
 * @method \Elasticsearchphp\Components\Filters\GeoDistanceRange GeoDistanceRange() GeoDistanceRange()
 * @method \Elasticsearchphp\Components\Filters\GeoPolygon GeoPolygon() GeoPolygon()
 * @method \Elasticsearchphp\Components\Filters\HasChild HasChild() HasChild()
 * @method \Elasticsearchphp\Components\Filters\HasParent HasParent() HasParent()
 * @method \Elasticsearchphp\Components\Filters\Ids Ids() Ids()
 * @method \Elasticsearchphp\Components\Filters\Limit Limit() Limit()
 * @method \Elasticsearchphp\Components\Filters\MatchAll MatchAll() MatchAll()
 * @method \Elasticsearchphp\Components\Filters\Missing Missing() Missing()
 * @method \Elasticsearchphp\Components\Filters\Nested Nested() Nested()
 * @method \Elasticsearchphp\Components\Filters\Not Not() Not()
 * @method \Elasticsearchphp\Components\Filters\NumericRange NumericRange() NumericRange()
 * @method \Elasticsearchphp\Components\Filters\OrFilter OrFilter() OrFilter()
 * @method \Elasticsearchphp\Components\Filters\Prefix Prefix() Prefix()
 * @method \Elasticsearchphp\Components\Filters\Query Query() Query()
 * @method \Elasticsearchphp\Components\Filters\Range Range() Range()
 * @method \Elasticsearchphp\Components\Filters\Script Script() Script()
 * @method \Elasticsearchphp\Components\Filters\Term Term() Term()
 * @method \Elasticsearchphp\Components\Filters\Terms Terms() Terms()
 * @method \Elasticsearchphp\Components\Filters\Type Type() Type()
 */
class FilterWrapper
{
    /**
     * @var \Elasticsearchphp\Components\FilterInterface
     */
    protected $filter;

    public function __call($name, $arguments)
    {
        $class = '\\Elasticsearchphp\\Components\\Filters\\'.$name;

        if (count($arguments) > 0) $this->filter =  new $class($arguments[0]);
        else $this->filter =  new $class();

        return $this->filter;
    }

    public function __toString()
    {
        return (string) $this->filter;
    }

}
