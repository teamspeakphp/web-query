<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetClientsResponseClient
{
    private function __construct(
        public int $databaseId,
        public ?string $nickname,
        public ?string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{cldbid: string, client_nickname?: string, client_unique_identifier?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cldbid'],
            $attributes['client_nickname'] ?? null,
            $attributes['client_unique_identifier'] ?? null,
        );
    }
}
