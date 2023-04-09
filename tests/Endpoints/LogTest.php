<?php

declare(strict_types=1);

namespace Tests\Endpoints;

use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;
use Tests\TestCase;

final class LogTest extends TestCase
{
    /**
     * @vcr log_test
     */
    public function testCreateLog(): void
    {
        $payload = new LogPayload(
            'test',
            'test',
            'test-event'
        );

        $payload->setDescription('test-description');
        $payload->setIcon('😀');

        $response = $this->client->createLog($payload);

        $this->assertEquals('test', $response['project']);
        $this->assertEquals('test', $response['channel']);
        $this->assertEquals('test-event', $response['event']);
        $this->assertEquals('test-description', $response['description']);
        $this->assertEquals('😀', $response['icon']);
    }

    /**
     * @vcr log_test
     */
    public function testCreateLogWithTags(): void
    {
        $payload = new LogPayload(
            'test',
            'test',
            'test-event'
        );

        $payload->setTags(['tag' => 'tag value']);

        $response = $this->client->createLog($payload);

        $this->assertEquals(['tag' => 'tag value'], $response['tags']);
    }

    /**
     * @vcr log_test
     */
    public function testCreateImportedLog(): void
    {
        $payload = new LogPayload(
            'test',
            'test',
            'test-imported-event'
        );

        $payload->setTimestamp((new \DateTime('1-1-2023'))->getTimestamp());

        $response = $this->client->createLog($payload);

        $this->assertEquals('test-imported-event', $response['event']);
    }
}
