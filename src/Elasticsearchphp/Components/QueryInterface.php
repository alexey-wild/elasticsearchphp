<?php

namespace Elasticsearchphp\Components;

/**
 * Interface for filter components, always used in conjunction with the BaseComponent class
 */
interface QueryInterface
{
    public function toArray();
    public function toJSON();
}
