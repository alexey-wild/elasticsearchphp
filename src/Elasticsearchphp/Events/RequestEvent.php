<?php

namespace Elasticsearchphp\Events;

use Elasticsearchphp\Requests\Request;
use Symfony\Component\EventDispatcher\Event;

class RequestEvent extends Event
{
    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function getRequest()
    {
        return $this->request;
    }
}