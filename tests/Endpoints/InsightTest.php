<?php

declare(strict_types=1);

namespace Tests\Endpoints;

use JoppeDc\LogsnagPhpSdk\Contracts\InsightPayload;
use JoppeDc\LogsnagPhpSdk\Contracts\MutateInsightPayload;
use Tests\TestCase;

class InsightTest extends TestCase
{
    /**
     * @vcr insight_test
     */
    public function testCreateInsight(): void
    {
        $payload = new InsightPayload(
            'test',
            'test',
            5
        );

        $response = $this->client->createInsight($payload);

        $this->assertEquals('test', $response['project']);
        $this->assertEquals('test', $response['title']);
        $this->assertEquals('5', $response['value']);
    }

    /**
     * @vcr insight_test
     */
    public function testMutateInsight(): void
    {
        $payload = new InsightPayload(
            'test',
            'mutated-insight',
            4
        );

        $response = $this->client->createInsight($payload);
        $this->assertEquals('test', $response['project']);

        $payload = new MutateInsightPayload(
            'test',
            'mutated-insight',
            2
        );

        $response = $this->client->mutateInsight($payload);
        $this->assertEquals('test', $response['project']);
    }
}
