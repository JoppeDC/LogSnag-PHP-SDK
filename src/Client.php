<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk;

use JoppeDc\LogsnagPhpSdk\Contracts\Http;
use JoppeDc\LogsnagPhpSdk\Endpoints\Delegates\HandlesInsight;
use JoppeDc\LogsnagPhpSdk\Endpoints\Delegates\HandlesLog;
use JoppeDc\LogsnagPhpSdk\Endpoints\Insight;
use JoppeDc\LogsnagPhpSdk\Endpoints\Log;
use JoppeDc\LogsnagPhpSdk\Http\Client as LogSnagClient;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class Client
{
    public const API_URL = 'https://api.logsnag.com/v1';

    use HandlesLog;
    use HandlesInsight;

    private Http $http;
    private Log $log;
    private Insight $insight;

    public function __construct(
        string $apiKey = null,
        ClientInterface $httpClient = null,
        RequestFactoryInterface $requestFactory = null,
        array $clientAgents = [],
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->http = new LogSnagClient(self::API_URL, $apiKey, $httpClient, $requestFactory, $clientAgents, $streamFactory);

        $this->log = new Log($this->http);
        $this->insight = new Insight($this->http);
    }
}
