<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Complaints;

use DateTimeImmutable;
use DateTimeZone;

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
     * @param  array{tcldbid: string, tname: string, fcldbid: string, fname: string, message: string, timestamp: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['tcldbid'],
            $attributes['tname'],
            (int) $attributes['fcldbid'],
            $attributes['fname'],
            $attributes['message'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['timestamp'])->setTimezone(new DateTimeZone('UTC')),
        );
    }
}
