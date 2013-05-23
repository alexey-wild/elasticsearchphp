<?php

namespace Elasticsearchphp\Components;

/** Interface for Mapping components, always used in conjunction with the BaseComponent class */
interface MappingInterface
{
    public function getType();
    public function toArray();
    public function toJSON();
}