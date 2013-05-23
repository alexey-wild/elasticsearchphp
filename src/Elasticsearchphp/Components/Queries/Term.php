<?php

namespace Elasticsearchphp\Components\Queries;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Queries\Term field() field(\string $value)
 * @method Elasticsearchphp\Components\Queries\Term term() term(\string $value)
 */
class Term extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\QueryInterface
{
    public function __construct($hashMap = null)
    {
        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
          'term' =>
          array (
            $this->params["field"] =>
            array (
              'value' => $this->params["term"],
            ),
          ),
        );

        return $ret;
    }

}
