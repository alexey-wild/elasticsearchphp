<?php

namespace Elasticsearchphp\Wrappers;

use Elasticsearchphp\Components\Queries;

/**
 * @method \Elasticsearchphp\Components\Queries\Bool Bool() Bool()
 * @method \Elasticsearchphp\Components\Queries\Boosting Boosting() Boosting()
 * @method \Elasticsearchphp\Components\Queries\ConstantScore ConstantScore() ConstantScore()
 * @method \Elasticsearchphp\Components\Queries\CustomBoostFactor CustomBoostFactor() CustomBoostFactor()
 * @method \Elasticsearchphp\Components\Queries\CustomFiltersScore CustomFiltersScore() CustomFiltersScore()
 * @method \Elasticsearchphp\Components\Queries\CustomScore CustomScore() CustomScore()
 * @method \Elasticsearchphp\Components\Queries\DisMax DisMax() DisMax()
 * @method \Elasticsearchphp\Components\Queries\Field Field() Field()
 * @method \Elasticsearchphp\Components\Queries\FilteredQuery FilteredQuery() FilteredQuery()
 * @method \Elasticsearchphp\Components\Queries\Fuzzy Fuzzy() Fuzzy()
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThis FuzzyLikeThis() FuzzyLikeThis()
 * @method \Elasticsearchphp\Components\Queries\FuzzyLikeThisField FuzzyLikeThisField() FuzzyLikeThisField()
 * @method \Elasticsearchphp\Components\Queries\HasChild HasChild() HasChild()
 * @method \Elasticsearchphp\Components\Queries\HasParent HasParent() HasParent()
 * @method \Elasticsearchphp\Components\Queries\Ids Ids() Ids()
 * @method \Elasticsearchphp\Components\Queries\Indices Indices() Indices()
 * @method \Elasticsearchphp\Components\Queries\Match Match() Match()
 * @method \Elasticsearchphp\Components\Queries\MatchAll MatchAll() MatchAll()
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThis MoreLikeThis() MoreLikeThis()
 * @method \Elasticsearchphp\Components\Queries\MoreLikeThisField MoreLikeThisField() MoreLikeThisField()
 * @method \Elasticsearchphp\Components\Queries\Nested Nested() Nested()
 * @method \Elasticsearchphp\Components\Queries\Prefix Prefix() Prefix()
 * @method \Elasticsearchphp\Components\Queries\QueryString QueryString() QueryString()
 * @method \Elasticsearchphp\Components\Queries\QueryStringMultiField QueryStringMultiField() QueryStringMultiField()
 * @method \Elasticsearchphp\Components\Queries\Range Range() Range()
 * @method \Elasticsearchphp\Components\Queries\Term Term() Term()
 * @method \Elasticsearchphp\Components\Queries\Terms Terms() Terms()
 * @method \Elasticsearchphp\Components\Queries\TopChildren TopChildren() TopChildren()
 * @method \Elasticsearchphp\Components\Queries\Wildcard Wildcard() Wildcard()
 * @method \Elasticsearchphp\Components\Queries\Raw Raw() Raw()
 */
class QueryWrapper
{
    /**
     * @var \Elasticsearchphp\Components\QueryInterface
     */
    protected $query;

    public function __call($name, $arguments)
    {
        $class = '\\Elasticsearchphp\\Components\\Queries\\'.$name;

        if (count($arguments) > 0) $this->query = new $class($arguments[0]);
        else $this->query =  new $class();

        return $this->query;
    }

    public function __toString()
    {
        return (string) $this->query;
    }

}
