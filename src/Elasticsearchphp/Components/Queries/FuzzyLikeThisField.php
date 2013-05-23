<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField like_text() like_text(\string $value)
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField max_query_terms() max_query_terms(\int $value) Default: 10
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField min_similarity() min_similarity(\float $value) Default: 0.5
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField prefix_length() prefix_length(\int $value) Default: 3
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField boost() boost(\float $value) Default: 2.0
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField analyzer() analyzer(\string $value) Default: "default"
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField ignore_tf() ignore_tf(\bool $value) Default: false
 */
class FuzzyLikeThisField extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['max_query_terms'] = 10;
        $this->params['min_similarity'] = 0.5;
        $this->params['prefix_length'] = 3;
        $this->params['boost'] = 2.0;
        $this->params['analyzer'] = "default";
        $this->params['ignore_tf'] = false;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array ('fuzzy_like_this_field' =>
              array ($this->params["field"] => array(
                    'like_text' => $this->params["like_text"],
                    'max_query_terms' => $this->params["max_query_terms"],
                    'min_similarity' => $this->params["min_similarity"],
                    'prefix_length' => $this->params["prefix_length"],
                    'boost' => $this->params["boost"],
                    'analyzer' => $this->params["analyzer"],
                    'ignore_tf' => $this->params["ignore_tf"]
                    )
              )
            );

        return $ret;
    }

}
