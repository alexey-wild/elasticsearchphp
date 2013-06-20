<?php

namespace Elasticsearchphp\Responses;

class DeleteResponse extends Response
{
    /**
     * @var bool
     */
    public $found;

    /**
     * @param \Elasticsearchphp\RollingCurl\Request $response
     */
    public function __construct($response)
    {
        parent::__construct($response);

        if (isset($this->responseData['found'])) {
            $this->ok = $this->responseData['found'];
        }

    }

}