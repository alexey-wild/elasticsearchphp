<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Fuzzy field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Fuzzy value() value(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Fuzzy boost() boost(\float $value) Default: 1.0
 * @method \Elasticsearchphp\Components\Queries\Fuzzy min_similarity() min_similarity(\float $value) Default: 0.2
 * @method \Elasticsearchphp\Components\Queries\Fuzzy prefix_length() prefix_length(\int $value) Default: 0
 * @method \Elasticsearchphp\Components\Queries\Fuzzy max_expansions() max_expansions(\int $value) Default: 10
 */
class Fuzzy extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 1.0;
        $this->params['min_similarity'] = 0.2;
        $this->params['prefix_length'] = 0;
        $this->params['max_expansions'] = 10;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'fuzzy' =>
          array (
            $this->params["field"] =>
            array (
              'value' => $this->params["value"],
              'boost' => $this->params["boost"],
              'min_similarity' => $this->params["min_similarity"],
              'prefix_length' => $this->params["prefix_length"],
              'max_expansions' => $this->params["max_expansions"],
            ),
          ),
        );

        return $ret;
    }

}
