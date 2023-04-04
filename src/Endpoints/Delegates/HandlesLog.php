<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Endpoints\Delegates;

use JoppeDc\LogsnagPhpSdk\Contracts\LogPayload;

trait HandlesLog
{
    public function createLog(LogPayload $payload): array
    {
        return $this->log->create($payload);
    }
}
