<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Filters\Term field() field(\string $value)
 * @method Elasticsearchphp\Components\Filters\Term term() term(\string $value)
 * @method Elasticsearchphp\Components\Filters\Term _cache() _cache(\bool $value) Default: true
 */
class Term extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['_cache'] = true;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
              'term' =>
              array (
                $this->params["field"] => $this->params["term"],
                '_cache' => $this->params["_cache"],
              ),
            );

        return $ret;
    }

}
