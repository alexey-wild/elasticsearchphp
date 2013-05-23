<?php

namespace Elasticsearchphp\Requests;

/**
 * Class CommandInterface
 */
interface CommandInterface
{
    /**
     * @return string
     */
    public function getURI();

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return string
     */
    public function getData();
}
