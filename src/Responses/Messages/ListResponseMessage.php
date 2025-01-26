<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Messages;

use DateTimeImmutable;

final readonly class ListResponseMessage
{
    private function __construct(
        public int $id,
        public string $senderUniqueIdentifier,
        public string $subject,
        public DateTimeImmutable $time,
        public bool $read,
    ) {}

    /**
     * @param  array{msgid: string, cluid: string, subject: string, timestamp: string, flag_read: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['msgid'],
            $attributes['cluid'],
            $attributes['subject'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['timestamp']),
            (bool) $attributes['flag_read'],
        );
    }
}
