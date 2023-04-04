<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Contracts;

abstract class Endpoint
{
    protected const PATH = '';
    protected Http $http;
    protected ?string $apiKey;

    public function __construct(Http $http, ?string $apiKey = null)
    {
        $this->http = $http;
        $this->apiKey = $apiKey;
    }
}
