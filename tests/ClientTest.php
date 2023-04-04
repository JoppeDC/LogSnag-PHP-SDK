<?php

declare(strict_types=1);

namespace Tests;

use JoppeDc\LogsnagPhpSdk\Client;
use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;
use JoppeDc\LogsnagPhpSdk\Exceptions\CommunicationException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testThrowCommunicationException(): void
    {
        $client = new Client('https://doesntexist:1234');

        $this->expectException(CommunicationException::class);
        $client->createLog(new LogPayload('', '', ''));
    }
}
