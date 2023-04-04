<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Exceptions;

class CommunicationException extends \Exception
{
    public function __toString()
    {
        return 'LogSnag CommunicationException: '.$this->getMessage();
    }
}
