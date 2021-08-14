<?php

namespace Woren951\OEmbeds\Support;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;

abstract class AbstractHttpException extends Exception
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var string
     */
    protected $responseBody;

    /**
     * @param ClientException $e
     * @return $this
     */
    public static function make(ClientException $e): self
    {
        return (new static())
            ->setRequest(
                $e->getRequest()
            )
            ->setResponseCode(
                $e->getCode()
            )
            ->setResponseBody(
                $e->getResponse()->getBody()->getContents()
            );
    }

    /**
     * @param Request $request
     * @return self
     */
    public function setRequest(Request $request): self
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setResponseCode(int $code): self
    {
        $this->responseCode = $code;

        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setResponseBody(string $body): self
    {
        $this->responseBody = $body;

        return $this;
    }
}
