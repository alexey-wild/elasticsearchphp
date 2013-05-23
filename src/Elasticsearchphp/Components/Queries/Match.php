<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

// method Elasticsearchphp\Components\Queries\Match fuzzy_rewrite() fuzzy_rewrite(\string $value) Default: 'constant_score_default'
/**
 * @method Elasticsearchphp\Components\Queries\Match field() field(\string $value)
 * @method Elasticsearchphp\Components\Queries\Match query() query(\string $value)
 * @method Elasticsearchphp\Components\Queries\Match boost() boost(\float $value) Default: 1.0
 * @method Elasticsearchphp\Components\Queries\Match operator() operator(\string $value) Default: 'and'
 * @method Elasticsearchphp\Components\Queries\Match analyzer() analyzer(\string $value) Default: 'default'
 * @method Elasticsearchphp\Components\Queries\Match fuzziness() fuzziness(\float $value) Default: null
 * @method Elasticsearchphp\Components\Queries\Match lenient() lenient(\bool $value) Default: true
 * @method Elasticsearchphp\Components\Queries\Match max_expansions() max_expansions(\int $value) Default: 100
 * @method Elasticsearchphp\Components\Queries\Match minimum_should_match() minimum_should_match(\int $value) Default: 2
 * @method Elasticsearchphp\Components\Queries\Match prefix_length() prefix_length(\int $value) Default: 2
 * @method Elasticsearchphp\Components\Queries\Match type() type(\string $value) Default: null
 */
class Match extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 1.0;
        $this->params['operator'] = 'and';
        $this->params['analyzer'] = 'default';
        $this->params['fuzziness'] = null;
        //$this->params['fuzzy_rewrite'] = 'constant_score_default';
        $this->params['lenient'] = true;
        $this->params['max_expansions'] = 100;
        $this->params['minimum_should_match'] = 2;
        $this->params['prefix_length'] = 2;
        $this->params['type'] = null;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'match' =>
          array (
            $this->params["field"] =>
            array (
              'query' => $this->params["query"],
              'boost' => $this->params["boost"],
              'operator' => $this->params["operator"],
              'analyzer' => $this->params["analyzer"],
              'fuzziness' => $this->params["fuzziness"],
             // 'fuzzy_rewrite' => $this->params["fuzzy_rewrite"],
              'lenient' => $this->params["lenient"],
              'max_expansions' => $this->params["max_expansions"],
              'minimum_should_match' => $this->params["minimum_should_match"],
              'prefix_length' => $this->params["prefix_length"],
              'type' => $this->params["type"]
            ),
          ),
        );

        return $ret;
    }

}
