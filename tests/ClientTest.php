<?php

declare(strict_types=1);

namespace Tests;

use JoppeDc\LogsnagPhpSdk\Client;
use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;
use JoppeDc\LogsnagPhpSdk\Exceptions\ApiException;
use JoppeDc\LogsnagPhpSdk\Exceptions\CommunicationException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testThrowCommunicationException(): void
    {
        $client = new Client('testkey');

        $this->expectException(ApiException::class);
        $client->createLog(new LogPayload('', '', ''));
    }
}
