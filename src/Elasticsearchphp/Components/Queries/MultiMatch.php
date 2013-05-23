<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @todo Does not have a toArray() method!
 *
 * @method \Elasticsearchphp\Components\Queries\MultiMatch fields() fields(array $fieldNames)  Field to search
 * @method \Elasticsearchphp\Components\Queries\MultiMatch query() query(\string $query)    query to search
 *
 * @method \Elasticsearchphp\Components\Queries\MultiMatch boost() boost(\float $value) Optional boosting for term value. Default = 1
 * @method \Elasticsearchphp\Components\Queries\MultiMatch operator() operator(\string $operator) Optional operator for match query. Default = 'and'
 * @method \Elasticsearchphp\Components\Queries\MultiMatch analyzer() analyzer(\string $analyzer) Optional analyzer for match query. Default to 'default'
 * @method \Elasticsearchphp\Components\Queries\MultiMatch fuzziness() fuzziness(\float $value) Optional amount of fuzziness. Default to null
 * @method \Elasticsearchphp\Components\Queries\MultiMatch fuzzy_rewrite() fuzzy_rewrite(\string $value) Default to 'constant_score_default'
 * @method \Elasticsearchphp\Components\Queries\MultiMatch lenient() lenient(\int $value) Default to 1
 * @method \Elasticsearchphp\Components\Queries\MultiMatch max_expansions() max_expansions(\int $value) Default to 100
 * @method \Elasticsearchphp\Components\Queries\MultiMatch minimum_should_match() minimum_should_match(\int $value) Default to 2
 * @method \Elasticsearchphp\Components\Queries\MultiMatch prefix_length() prefix_length(\int $value) Default to 2
 * @method \Elasticsearchphp\Components\Queries\MultiMatch use_dis_max() use_dis_max(\int $value) Default to 1
 * @method \Elasticsearchphp\Components\Queries\MultiMatch tie_breaker() tie_breaker(\float $value) Default to 0.7
 */
class MultiMatch extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {

        $this->params['boost'] = 1;
        $this->params['operator'] = 'and';
        $this->params['analyzer'] = 'default';
        $this->params['fuzziness'] = null;
        $this->params['fuzzy_rewrite'] = 'constant_score_default';
        $this->params['lenient'] = 1;
        $this->params['max_expansions'] = 100;
        $this->params['minimum_should_match'] = 2;
        $this->params['prefix_length'] = 2;
        $this->params['use_dis_max'] = 1;
        $this->params['tie_breaker'] = 0.7;
        
        parent::__construct($hashMap);
    }

}
