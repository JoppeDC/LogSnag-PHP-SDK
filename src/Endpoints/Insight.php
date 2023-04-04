<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Endpoints;

use JoppeDc\LogsnagPhpSdk\Contracts\Endpoint;
use JoppeDc\LogsnagPhpSdk\Contracts\InsightPayload;
use JoppeDc\LogsnagPhpSdk\Contracts\MutateInsightPayload;
use JoppeDc\LogsnagPhpSdk\Exceptions\ApiException;

class Insight extends Endpoint
{
    protected const PATH = '/insight';

    /**
     * @throws \Exception|ApiException
     */
    public function create(InsightPayload $payload): array
    {
        $body = $payload->toArray();

        return $this->http->post(self::PATH, $body);
    }

    /**
     * @throws \Exception|ApiException
     */
    public function mutate(MutateInsightPayload $payload): array
    {
        $body = $payload->toArray();

        return $this->http->patch(self::PATH, $body);
    }
}
