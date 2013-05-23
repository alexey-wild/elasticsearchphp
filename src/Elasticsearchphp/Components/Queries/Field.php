<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\Field field() field(\string $value)
 * @method Elasticsearchphp\Components\Queries\Field query() query(\string $value)
 * @method Elasticsearchphp\Components\Queries\Field boost() boost(\float $value) Default: 2.0
 * @method Elasticsearchphp\Components\Queries\Field enable_position_increments() enable_position_increments(\int $value) Default: 1
 * @method Elasticsearchphp\Components\Queries\Field default_operator() default_operator(\string $value) Default: "AND"
 * @method Elasticsearchphp\Components\Queries\Field analyzer() analyzer(\string $value) Default: "default"
 * @method Elasticsearchphp\Components\Queries\Field allow_leading_wildcard() allow_leading_wildcard(\bool $value) Default: false
 * @method Elasticsearchphp\Components\Queries\Field lowercase_expanded_terms() lowercase_expanded_terms(\int $value) Default: 1
 * @method Elasticsearchphp\Components\Queries\Field fuzzy_min_sim() fuzzy_min_sim(\float $value) Default: 0.5
 * @method Elasticsearchphp\Components\Queries\Field fuzzy_prefix_length() fuzzy_prefix_length(\int $value) Default: 2
 * @method Elasticsearchphp\Components\Queries\Field phrase_slop() phrase_slop(\int $value) Default: 10
 * @method Elasticsearchphp\Components\Queries\Field analyze_wildcard() analyze_wildcard(\bool $value) Default: true
 * @method Elasticsearchphp\Components\Queries\Field auto_generate_phrase_queries() auto_generate_phrase_queries(\int $value) Default: 0
 * @method Elasticsearchphp\Components\Queries\Field rewrite() rewrite(\string $value) Default: "constant_score_default"
 * @method Elasticsearchphp\Components\Queries\Field quote_analyzer() quote_analyzer(\string $value) Default: "standard"
 * @method Elasticsearchphp\Components\Queries\Field quote_field_suffix() quote_field_suffix(\string $value) Default: ".unstemmed"
 */
class Field extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['boost'] = 2.0;
        $this->params['enable_position_increments'] = 1;
        $this->params['default_operator'] = "AND";
        $this->params['analyzer'] = "default";
        $this->params['allow_leading_wildcard'] = false;
        $this->params['lowercase_expanded_terms'] = 1;
        $this->params['fuzzy_min_sim'] = 0.5;
        $this->params['fuzzy_prefix_length'] = 2;
        $this->params['phrase_slop'] = 10;
        $this->params['analyze_wildcard'] = true;
        $this->params['auto_generate_phrase_queries'] = 0;
        $this->params['rewrite'] = "constant_score_default";
        $this->params['quote_analyzer'] = "standard";
        $this->params['quote_field_suffix'] = ".unstemmed";

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'field' =>
          array (
            $this->params["field"] =>
            array (
              'query' => $this->params["query"],
              'boost' => $this->params["boost"],
              'enable_position_increments' => $this->params["enable_position_increments"],
              'default_operator' => $this->params["default_operator"],
              'analyzer' => $this->params["analyzer"],
              'allow_leading_wildcard' => $this->params["allow_leading_wildcard"],
              'lowercase_expanded_terms' => $this->params["lowercase_expanded_terms"],
              'fuzzy_min_sim' => $this->params["fuzzy_min_sim"],
              'fuzzy_prefix_length' => $this->params["fuzzy_prefix_length"],
              'phrase_slop' => $this->params["phrase_slop"],
              'analyze_wildcard' => $this->params["analyze_wildcard"],
              'auto_generate_phrase_queries' => $this->params["auto_generate_phrase_queries"],
              'quote_analyzer' => $this->params["quote_analyzer"],
              'quote_field_suffix' => $this->params["quote_field_suffix"],
            ),
            'rewrite' => $this->params["rewrite"]

          )
        );

        return $ret;
    }

}
