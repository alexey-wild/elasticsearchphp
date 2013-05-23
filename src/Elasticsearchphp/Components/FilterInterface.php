<?php

namespace Elasticsearchphp\Components;

/**
 * Interface for filter components, always used in conjunction with the BaseComponent class
 */
interface FilterInterface
{
    public function toArray();
    public function toJSON();
}
