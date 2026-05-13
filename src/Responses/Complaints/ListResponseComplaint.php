<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Complaints;

use DateTimeImmutable;

final class ListResponseComplaint
{
    private function __construct(
        public int $targetClientDatabaseId,
        public string $targetClientName,
        public int $fromClientDatabaseId,
        public string $fromClientName,
        public string $message,
        public DateTimeImmutable $timestamp,
    ) {}

    /**
     * @param  array{tcldbid: string, tclname: string, fcldbid: string, fclname: string, message: string, timestamp: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['tcldbid'],
            $attributes['tclname'],
            (int) $attributes['fcldbid'],
            $attributes['fclname'],
            $attributes['message'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['timestamp']),
        );
    }
}
