<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\NumericRange field() field(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\NumericRange from() from(\int $value)
 * @method  \Elasticsearchphp\Components\Filters\NumericRange to() to(\int $value)
 * @method  \Elasticsearchphp\Components\Filters\NumericRange include_lower() include_lower(\bool $value) Default: true
 * @method  \Elasticsearchphp\Components\Filters\NumericRange include_upper() include_upper(\bool $value) Default: false
 * @method  \Elasticsearchphp\Components\Filters\NumericRange _cache() _cache(\bool $value) Default: false
 */
class NumericRange extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['include_lower'] = true;
        $this->params['include_upper'] = false;
        $this->params['_cache'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'numeric_range' =>
          array (
            $this->params["field"] =>
            array (
              'from' => $this->params["from"],
              'to' => $this->params["to"],
              'include_lower' => $this->params["include_lower"],
              'include_upper' => $this->params["include_upper"],
            ),
            '_cache' => $this->params["_cache"],
          ),
        );

        return $ret;
    }

}
