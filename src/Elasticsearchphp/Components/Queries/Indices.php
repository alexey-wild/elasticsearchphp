<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Indices no_match_query() no_match_query(\sherlock\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\Indices query() query(\sherlock\components\QueryInterface $value)
 */
class Indices extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    /**
     * @param  array | string $indices,...
     * @return Indices
     */
    public function indices($indices)
    {
        $args = func_get_args();

        //single param, array of strings
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) if (is_string($arg)) $this->params['indices'][] = $arg;

        return $this;
    }

    public function toArray()
    {
        $ret = array (
          'indices' =>
          array (
            'indices' => $this->params["indices"],
            'query' => $this->params["query"]->toArray(),
            'no_match_query' => $this->params["no_match_query"]->toArray(),
          ),
        );

        return $ret;
    }

}
