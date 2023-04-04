<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Endpoints;

use JoppeDc\LogsnagPhpSdk\Contracts\Endpoint;
use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;
use JoppeDc\LogsnagPhpSdk\Exceptions\ApiException;

class Log extends Endpoint
{
    protected const PATH = '/log';

    /**
     * @throws \Exception|ApiException
     */
    public function create(LogPayload $payload): array
    {
        $body = $payload->toArray();

        return $this->http->post(self::PATH, $body);
    }
}
