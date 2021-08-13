<?php

namespace Woren951\OEmbeds\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var string
     */
    protected $responseBody;

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
