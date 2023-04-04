<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Contracts;

class MutateInsightPayload extends InsightPayload
{
    public function toArray(): array
    {
        $array = [
            'project' => $this->project,
            'title' => $this->title,
            'value' => [
                '$inc' => $this->value,
            ],
            'icon' => $this->icon,
        ];

        return array_filter($array, function ($item) { return null !== $item && !empty($item); });
    }
}
