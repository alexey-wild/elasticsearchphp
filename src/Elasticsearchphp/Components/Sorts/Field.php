<?php

namespace Elasticsearchphp\Components\Sorts;

use Elasticsearchphp\Components;

/**
 * @method Elasticsearchphp\Components\Sorts\Field name() name(\string $value)
 * @method Elasticsearchphp\Components\Sorts\Field order() order(\string $value) Default: null
 * @method Elasticsearchphp\Components\Sorts\Field missing() missing(\string $value) Default: null
 * @method Elasticsearchphp\Components\Sorts\Field ignore_unmapped() ignore_unmapped(\bool $value) Default: null
 */
class Field extends Elasticsearchphp\Components\BaseComponent implements Elasticsearchphp\Components\SortInterface
{
    public function __construct($hashMap = null)
    {
        $this->params['order'] = null;
        $this->params['sort_mode'] = null;
        $this->params['order'] = null;
        $this->params['missing'] = null;
        $this->params['ignore_unmapped'] = null;

        parent::__construct($hashMap);
    }

    public function toArray()
    {
        $ret = array (
            $this->params['name'] =>
            array (
                'sort_mode' => $this->params["sort_mode"],
                'order' => $this->params["order"],
                'missing' => $this->params["missing"],
                'ignore_unmapped' => $this->params["ignore_unmapped"],
            ),
        );

        return $ret;
    }

}
