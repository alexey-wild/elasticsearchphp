<?php

namespace Elasticsearchphp\Responses;

class DocumentResponse extends Response
{

    /**
     * @param  \Elasticsearchphp\RollingCurl\Request           $response
     *
     * @throws \Elasticsearchphp\Exceptions\BadMethodCallException
     */
    public function __construct($response)
    {
        parent::__construct($response);

        foreach ($this->responseData as $key => $value) {
            if (substr($key, 0, 1) == '_') {
                $this->responseData[ltrim($key, '_')] = $value;
                unset($this->responseData[$key]);
            }
        }
    }
}