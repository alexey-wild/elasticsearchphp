<?php

namespace Elasticsearchphp\Responses;

class IndexResponse extends Response
{
    
    /**
     * @var int
     */
    public $ok;

    /**
     * @var int
     */
    public $acknowledged;

    /**
     * @param \Elasticsearchphp\Common\tmp\RollingCurl\Request $response
     */
    public function __construct($response)
    {
        parent::__construct($response);

        if (isset($this->responseData['ok'])) $this->ok = $this->responseData['ok'];

        if (isset($this->responseData['acknowledged'])) $this->acknowledged = $this->responseData['acknowledged'];
    }

}
