<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\CustomScore query() query(\sherlock\components\QueryInterface $value)
 * @method \Elasticsearchphp\Components\Queries\CustomScore params() params(array $value)
 * @method \Elasticsearchphp\Components\Queries\CustomScore script() script(\string $value)
 * @method \Elasticsearchphp\Components\Queries\CustomScore lang() lang(\string $value) Default: "mvel"
 */
class CustomScore extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['lang'] = "mvel";

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'custom_score' =>
          array (
            'query' => $this->params["query"]->toArray(),
            'params' => $this->params["params"],
            'script' => $this->params["script"],
            'lang' => $this->params["lang"],
          ),
        );

        return $ret;
    }

}
