<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\DatabaseClients;

final readonly class ListResponse
{
    /**
     * @param  array<int, ListResponseClient>  $clients
     */
    private function __construct(
        public array $clients,
        public ?int $count,
    ) {}

    /**
     * Create a new response from the given attributes.
     *
     * @param  list<array{cldbid: string, client_created: string, client_description: string, client_lastconnected: string, client_lastip: string, client_login_name: string, client_nickname: string, client_totalconnections: string, client_unique_identifier: string, count?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $attributes): ListResponseClient => ListResponseClient::from($attributes), $attributes),
            isset($attributes[0]['count']) ? (int) $attributes[0]['count'] : null,
        );
    }
}
