<?php

declare(strict_types=1);

namespace Tests;

use JoppeDc\LogsnagPhpSdk\Client;
use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;
use JoppeDc\LogsnagPhpSdk\Exceptions\ApiException;

class ClientTest extends TestCase
{
    /**
     * @vcr client_test_throw_validation_error
     */
    public function testThrowValidationError(): void
    {
        $client = new Client('testkey');

        $this->expectException(ApiException::class);
        $client->createLog(new LogPayload('', '', ''));
    }
}
