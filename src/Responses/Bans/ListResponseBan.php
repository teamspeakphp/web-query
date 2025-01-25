<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Bans;

use DateTimeImmutable;

final class ListResponseBan
{
    private function __construct(
        public int $id,
        public DateTimeImmutable $created,
        public int $duration,
        public int $enforcements,
        public int $invokerDatabaseId,
        public string $invokerName,
        public string $invokerUniqueIdentifier,
        public ?string $ipAddress,
        public ?string $lastNickname,
        public ?string $myTeamspeakId,
        public ?string $name,
        public ?string $reason,
        public ?string $uniqueIdentifier,
    ) {}

    /**
     * Create a new ban from the given attributes.
     *
     * @param  array{banid: string, created: string, duration: string, enforcements: string, invokercldbid: string, invokername: string, invokeruid: string, ip: string, lastnickname: string, mytsid: string, name: string, reason: string, uid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['banid'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['created']),
            (int) $attributes['duration'],
            (int) $attributes['enforcements'],
            (int) $attributes['invokercldbid'],
            $attributes['invokername'],
            $attributes['invokeruid'],
            $attributes['ip'] ?: null,
            $attributes['lastnickname'] ?: null,
            $attributes['mytsid'] ?: null,
            $attributes['name'] ?: null,
            $attributes['reason'] ?: null,
            $attributes['uid'] ?: null,
        );
    }
}
