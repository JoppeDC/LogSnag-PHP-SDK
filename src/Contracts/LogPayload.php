<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Contracts;

class LogPayload
{
    public const PARSER_TEXT = 'text';
    public const PARSER_MARKDOWN = 'markdown';

    private string $project;
    private string $channel;
    private string $event;
    private bool $notify = true;
    private array $tags = [];
    private string $parser = self::PARSER_TEXT;

    private ?string $description = null;
    private ?string $icon = null;
    private ?int $timestamp = null;

    public function __construct(
        string $project,
        string $channel,
        string $event
    ) {
        $this->project = $project;
        $this->channel = $channel;
        $this->event = $event;
    }

    public function getProject(): string
    {
        return $this->project;
    }

    public function setProject(string $project): void
    {
        $this->project = $project;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): void
    {
        $this->channel = $channel;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function setEvent(string $event): void
    {
        $this->event = $event;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    public function isNotify(): bool
    {
        return $this->notify;
    }

    public function setNotify(bool $notify): void
    {
        $this->notify = $notify;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getParser(): string
    {
        return $this->parser;
    }

    public function setParser(string $parser): void
    {
        $this->parser = $parser;
    }

    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    public function setTimestamp(?int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $array = [
            'project' => $this->project,
            'channel' => $this->channel,
            'event' => $this->event,
            'description' => $this->description,
            'icon' => $this->icon,
            'notify' => $this->notify,
            'tags' => $this->tags,
            'parser' => $this->parser,
            'timestamp' => $this->timestamp,
        ];

        return array_filter($array, function ($item) { return null !== $item && !empty($item); });
    }
}
