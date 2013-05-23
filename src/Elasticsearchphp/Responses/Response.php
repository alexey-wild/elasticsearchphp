<?php

namespace Elasticsearchphp\Responses;

use Elasticsearchphp\Exceptions;

class Response
{
    /**
     * @var array
     */
    public $responseData;

    /**
     * @var array
     */
    public $responseInfo;

    /**
     * @var array
     */
    public $responseError;


    /**
     * @param  \Elasticsearchphp\Common\tmp\RollingCurl\Request $response
     * @throws \Elasticsearchphp\Exceptions\ServerErrorResponseException
     * @throws \Elasticsearchphp\Exceptions\BadResponseException
     */
    public function __construct($response)
    {
        if (!isset($response)) throw new exceptions\BadResponseException("Response must be set in constructor.");

        $this->responseInfo = $response->getResponseInfo();
        $this->responseError = $response->getResponseError();

        $this->responseData = json_decode($response->getResponseText(), true);

        if ($this->responseInfo['http_code'] >= 400 && $this->responseInfo['http_code'] < 500) $this->process4xx();
        elseif ($this->responseInfo['http_code'] >= 500) $this->process5xx();
    }

    /**
     * @throws \Elasticsearchphp\Exceptions\IndexAlreadyExistsException
     * @throws \Elasticsearchphp\Exceptions\ClientErrorResponseException
     * @throws \Elasticsearchphp\Exceptions\IndexMissingException
     */
    private function process4xx()
    {
        $error = $this->responseData['error'];

        if (strpos($error, "IndexMissingException") !== false) throw new exceptions\IndexMissingException($error);
        elseif (strpos($error, "IndexAlreadyExistsException") !== false) throw new exceptions\IndexAlreadyExistsException($error);
        else throw new exceptions\ClientErrorResponseException($error);
    }

    /**
     * @throws \Elasticsearchphp\Exceptions\ServerErrorResponseException
     * @throws \Elasticsearchphp\Exceptions\SearchPhaseExecutionException
     */
    private function process5xx()
    {
        $error = $this->responseData['error'];

        if (strpos($error, "SearchPhaseExecutionException") !== false)throw new exceptions\SearchPhaseExecutionException($error);
        else throw new exceptions\ServerErrorResponseException($error);
    }
}
