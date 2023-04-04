<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Endpoints\Delegates;

use JoppeDc\LogsnagPhpSdk\Contracts\InsightPayload;
use JoppeDc\LogsnagPhpSdk\Contracts\MutateInsightPayload;

trait HandlesInsight
{
    public function createInsight(InsightPayload $payload): array
    {
        return $this->insight->create($payload);
    }

    public function mutateInsight(MutateInsightPayload $payload): array
    {
        return $this->insight->mutate($payload);
    }
}
