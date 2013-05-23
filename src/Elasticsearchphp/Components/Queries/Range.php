<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method \Elasticsearchphp\Components\Queries\Range field() field(\string $value)
 * @method \Elasticsearchphp\Components\Queries\Range from() from(multi $value)
 * @method \Elasticsearchphp\Components\Queries\Range to() to(multi $value)
 * @method \Elasticsearchphp\Components\Queries\Range include_lower() include_lower(\bool $value) Default: true
 * @method \Elasticsearchphp\Components\Queries\Range include_upper() include_upper(\bool $value) Default: true
 * @method \Elasticsearchphp\Components\Queries\Range boost() boost(\float $value) Default: 1.0
 */
class Range extends \Elasticsearchphp\Components\BaseComponent implements \Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['include_lower'] = true;
        $this->params['include_upper'] = true;
        $this->params['boost'] = 1.0;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'range' =>
          array (
            $this->params["field"] =>
            array (
              'from' => $this->params["from"],
              'to' => $this->params["to"],
              'include_lower' => $this->params["include_lower"],
              'include_upper' => $this->params["include_upper"],
              'boost' => $this->params["boost"],
            ),
          ),
        );

        return $ret;
    }

}
