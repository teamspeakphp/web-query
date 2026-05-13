<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Logs;

use DateTimeImmutable;
use TeamSpeak\WebQuery\Enums\LogLevel;

final class ListResponseLog
{
    private function __construct(
        public DateTimeImmutable $timestamp,
        public LogLevel $level,
        public string $channel,
        public int $serverId,
        public string $message,
    ) {}

    /**
     * @param  array{l: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        $parts = explode('|', $attributes['l'], 5);

        $level = match (mb_trim($parts[1])) {
            'ERROR' => LogLevel::Error,
            'WARNING' => LogLevel::Warning,
            'DEBUG' => LogLevel::Debug,
            default => LogLevel::Info,
        };

        return new self(
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s.u', mb_trim($parts[0])) ?: new DateTimeImmutable(),
            $level,
            mb_trim($parts[2]),
            (int) mb_trim($parts[3]),
            mb_trim($parts[4] ?? ''),
        );
    }
}
