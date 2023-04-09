<?php

declare(strict_types=1);

namespace Tests;

use JoppeDc\LogsnagPhpSdk\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;
use VCR\Event\Event;
use VCR\VCR;
use VCR\VCREvents;

abstract class TestCase extends BaseTestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        VCR::getEventDispatcher()->addListener(VCREvents::VCR_BEFORE_RECORD, array($this, 'cleanRequest'));

        // Disable this line if you want to record new cassettes
        VCR::getEventDispatcher()->addListener(VCREvents::VCR_BEFORE_PLAYBACK, array($this, 'cleanRequest'));

        $this->client = new Client(getenv('LOGSNAG_API_KEY'));
    }

    public function cleanRequest(Event $event): void
    {
        $request = $event->getRequest();
        $request->removeHeader('Authorization');
    }
}
