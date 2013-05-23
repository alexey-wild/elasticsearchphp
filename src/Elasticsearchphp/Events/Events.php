<?php

namespace Elasticsearchphp\Events;

/** Class Events - Reference class for all events in dispatch system */
final class Events
{
    /**
     * request.preexecute event is thrown just prior to the event being executed.
     * Perfect for injecting a node address
     *
     * The event listener receives an \Elasticsearchphp\Events\RequestEvent
     *
     * @var string
     */
    const REQUEST_PREEXECUTE = 'request.preexecute';
}