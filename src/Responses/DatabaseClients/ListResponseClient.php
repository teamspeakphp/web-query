<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\DatabaseClients;

use DateTimeImmutable;

final readonly class ListResponseClient
{
    private function __construct(
        public int $databaseId,
        public DateTimeImmutable $created,
        public string $description,
        public DateTimeImmutable $lastConnected,
        public string $lastIpAddress,
        public string $loginName,
        public string $nickname,
        public int $totalConnections,
        public string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{cldbid: string, client_created: string, client_description: string, client_lastconnected: string, client_lastip: string, client_login_name: string, client_nickname: string, client_totalconnections: string, client_unique_identifier: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cldbid'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['client_created']),
            $attributes['client_description'],
            DateTimeImmutable::createFromTimestamp((int) $attributes['client_lastconnected']),
            $attributes['client_lastip'],
            $attributes['client_login_name'],
            $attributes['client_nickname'],
            (int) $attributes['client_totalconnections'],
            $attributes['client_unique_identifier'],
        );
    }
}
