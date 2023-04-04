<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Exceptions;

use Psr\Http\Message\ResponseInterface;

class InvalidResponseBodyException extends \Exception
{
    public $httpStatusCode = 0;
    public $httpBody = null;
    public $message = null;

    public function __construct(ResponseInterface $response, $httpBody, $previous = null)
    {
        $this->httpStatusCode = $response->getStatusCode();
        $this->httpBody = $httpBody;
        $this->message = $this->getMessageFromHttpBody() ?? $response->getReasonPhrase();

        parent::__construct($this->message, $this->httpStatusCode, $previous);
    }

    public function __toString()
    {
        $base = 'LogSnag InvalidResponseBodyException: Http Status: '.$this->httpStatusCode;

        if ($this->message) {
            $base .= ' - Message: '.$this->message;
        }

        return $base;
    }

    public function getMessageFromHttpBody(): ?string
    {
        if (null !== $this->httpBody) {
            $rawText = strip_tags($this->httpBody);

            if (!ctype_space($rawText)) {
                return substr(trim($rawText), 0, 100);
            }
        }

        return null;
    }
}
