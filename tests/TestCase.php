<?php

declare(strict_types=1);

namespace Tests;

use JoppeDc\LogsnagPhpSdk\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected Client $client;
    protected string $host;

    protected function setUp(): void
    {
        parent::setUp();

        $this->host = getenv('LOGSNAG_URL');
        $this->client = new Client($this->host, getenv('LOGSNAG_API_KEY'));
    }
}
