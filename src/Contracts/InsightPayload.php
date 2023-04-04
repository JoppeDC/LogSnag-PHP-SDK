<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Contracts;

class InsightPayload
{
    protected string $project;
    protected string $title;
    protected int $value;
    protected ?string $icon = null;

    public function __construct(
        string $project,
        string $title,
        int $value
    ) {
        $this->project = $project;
        $this->title = $title;
        $this->value = $value;
    }

    public function getProject(): string
    {
        return $this->project;
    }

    public function setProject(string $project): void
    {
        $this->project = $project;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function toArray(): array
    {
        $array = [
            'project' => $this->project,
            'title' => $this->title,
            'value' => $this->value,
            'icon' => $this->icon,
        ];

        return array_filter($array, function ($item) { return null !== $item && !empty($item); });
    }
}
