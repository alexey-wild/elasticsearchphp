<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField query() query(\string $value)
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField fields() fields(array $value)
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField boost() boost(\float $value) Default: 2.0
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField enable_position_increments() enable_position_increments(\bool $value) Default: true
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField default_operator() default_operator(\string $value) Default: "OR"
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField analyzer() analyzer(\string $value) Default: "default"
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField allow_leading_wildcard() allow_leading_wildcard(\bool $value) Default: false
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField lowercase_expanded_terms() lowercase_expanded_terms(\int $value) Default: 1
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField fuzzy_min_sim() fuzzy_min_sim(\float $value) Default: 0.5
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField fuzzy_prefix_length() fuzzy_prefix_length(\int $value) Default: 2
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField lenient() lenient(\int $value) Default: 1
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField phrase_slop() phrase_slop(\int $value) Default: 10
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField analyze_wildcard() analyze_wildcard(\bool $value) Default: true
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField auto_generate_phrase_queries() auto_generate_phrase_queries(\int $value) Default: 0
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField rewrite() rewrite(\string $value) Default: "constant_score_default"
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField quote_analyzer() quote_analyzer(\string $value) Default: "standard"
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField quote_field_suffix() quote_field_suffix(\string $value) Default: ".unstemmed"
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField use_dis_max() use_dis_max(\bool $value) Default: true
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField tie_breaker() tie_breaker(\int $value) Default: 1
 */
class QueryStringMultiField extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 2.0;
        // $this->params['enable_position_increments'] = true;
        $this->params['default_operator'] = "OR";
        $this->params['analyze_wildcard'] = true;
/*        $this->params['analyzer'] = "default";
        $this->params['allow_leading_wildcard'] = false;
        $this->params['lowercase_expanded_terms'] = 1;
        $this->params['fuzzy_min_sim'] = 0.5;
        $this->params['fuzzy_prefix_length'] = 2;
        $this->params['lenient'] = 1;
        $this->params['phrase_slop'] = 10;
        $this->params['auto_generate_phrase_queries'] = false;*/
//        $this->params['rewrite'] = "constant_score_default";
/*        $this->params['quote_analyzer'] = "standard";
        $this->params['quote_field_suffix'] = ".unstemmed";
        $this->params['use_dis_max'] = true;
        $this->params['tie_breaker'] = 1;*/

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'query_string' =>
              array (
                'query' => $this->params["query"],
                'fields' => $this->params["fields"],
                'default_operator' => $this->params["default_operator"],
                'analyze_wildcard' => $this->params["analyze_wildcard"]
/*                'enable_position_increments' => $this->params["enable_position_increments"],
                'boost' => $this->params["boost"],
                'analyzer' => $this->params["analyzer"],
                'allow_leading_wildcard' => $this->params["allow_leading_wildcard"],
                'lowercase_expanded_terms' => $this->params["lowercase_expanded_terms"],
                'fuzzy_min_sim' => $this->params["fuzzy_min_sim"],
                'fuzzy_prefix_length' => $this->params["fuzzy_prefix_length"],
                'lenient' => $this->params["lenient"],
                'phrase_slop' => $this->params["phrase_slop"],
                'auto_generate_phrase_queries' => $this->params["auto_generate_phrase_queries"],

                'quote_analyzer' => $this->params["quote_analyzer"],
                'quote_field_suffix' => $this->params["quote_field_suffix"],
                'use_dis_max' => $this->params["use_dis_max"],
                'tie_breaker' => $this->params["tie_breaker"],*/
              )
            //'rewrite' => $this->params["rewrite"],
        );

        return $ret;
    }

}
