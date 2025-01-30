<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetClientsResponse
{
    /**
     * @param  list<GetClientsResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{cldbid: string, client_nickname?: string, client_unique_identifier?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): GetClientsResponseClient => GetClientsResponseClient::from($result), $attributes),
        );
    }
}
