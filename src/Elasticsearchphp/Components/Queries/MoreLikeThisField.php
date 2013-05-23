<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField like_text() like_text(\string $value)
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField min_term_freq() min_term_freq(\int $value) Default: 2
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField max_query_terms() max_query_terms(\int $value) Default: 25
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField percent_terms_to_match() percent_terms_to_match(\float $value) Default: 0.3
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField stop_words() stop_words(array $value) Default: array()
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField min_doc_freq() min_doc_freq(\int $value) Default: 5
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField max_doc_freq() max_doc_freq(\int $value) Default: 0
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField min_word_len() min_word_len(\int $value) Default: 0
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField max_word_len() max_word_len(\int $value) Default: 0
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField boost_terms() boost_terms(\int $value) Default: 1
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField boost() boost(\float $value) Default: 1.0
 */
class MoreLikeThisField extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['min_term_freq'] = 2;
        $this->params['max_query_terms'] = 25;
        $this->params['percent_terms_to_match'] = 0.3;
        $this->params['stop_words'] = array();
        $this->params['min_doc_freq'] = 5;
        $this->params['max_doc_freq'] = 0;
        $this->params['min_word_len'] = 0;
        $this->params['max_word_len'] = 0;
        $this->params['boost_terms'] = 1;
        $this->params['boost'] = 1.0;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'more_like_this_field' =>
          array (
            $this->params["field"] =>
            array (
              'like_text' => $this->params["like_text"],
              'min_term_freq' => $this->params["min_term_freq"],
              'max_query_terms' => $this->params["max_query_terms"],
              'percent_terms_to_match' => $this->params["percent_terms_to_match"],
              'stop_words' => $this->params["stop_words"],
              'min_doc_freq' => $this->params["min_doc_freq"],
              'max_doc_freq' => $this->params["max_doc_freq"],
              'min_word_len' => $this->params["min_word_len"],
              'max_word_len' => $this->params["max_word_len"],
              'boost_terms' => $this->params["boost_terms"],
              'boost' => $this->params["boost"],
            ),
          ),
        );

        return $ret;
    }

}
