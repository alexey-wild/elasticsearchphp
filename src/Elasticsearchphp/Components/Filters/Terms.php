<?php

namespace Elasticsearchphp\Components\Filters;

use Elasticsearchphp\Components;

/**
 * @method  \Elasticsearchphp\Components\Filters\Terms field() field(\string $value)
 * @method  \Elasticsearchphp\Components\Filters\Terms execution() execution(\string $value) Default: "plain"
 * @method  \Elasticsearchphp\Components\Filters\Terms _cache() _cache(\bool $value) Default: true
 */
class Terms extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\FilterInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['execution'] = "plain";
        $this->params['_cache'] = true;

        parent::__construct($hashMap);
    }

    /**
     * @param  \string | array $terms,...
     * @return Terms
     */
    public function terms($terms)
    {
        $args = func_get_args();

        //single param, array of filters
        if (count($args) == 1 && is_array($args[0])) $args = $args[0];

        foreach ($args as $arg) if (is_string($arg)) $this->params['terms'][] = $arg;

        return $this;
    }

    public function toArray()
    {
        $ret = array (
            'terms' =>
            array (
                $this->params["field"] => $this->params["terms"],
                'execution' => $this->params["execution"],
                '_cache' => $this->params["_cache"],
                ),
            );

        return $ret;
    }

}
