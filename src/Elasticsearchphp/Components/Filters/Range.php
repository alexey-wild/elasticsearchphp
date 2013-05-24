<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Range field() field(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\Range from() from(mixed $value)
 * @method  \Elasticsearchphp\Components\Filters\Range to() to(mixed $value)
 * @method  \Elasticsearchphp\Components\Filters\Range include_lower() include_lower(\bool $value) Default: true
 * @method  \Elasticsearchphp\Components\Filters\Range include_upper() include_upper(\bool $value) Default: false
 * @method  \Elasticsearchphp\Components\Filters\Range _cache() _cache(\bool $value) Default: true
 */
class Range extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['include_lower'] = true;
        $this->params['include_upper'] = false;
        $this->params['_cache'] = true;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
            'range' =>
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
