<?php

namespace Elasticsearchphp\Components;

/**
 * Interface for sort components, always used in conjunction with the BaseComponent class
 */
interface SortInterface
{
    public function toArray();
    public function toJSON();
}
