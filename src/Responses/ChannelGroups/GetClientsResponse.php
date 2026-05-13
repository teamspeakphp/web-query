<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelGroups;

final readonly class GetClientsResponse
{
    /**
     * @param  list<GetClientsResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{cid: string, cldbid: string, cgid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(GetClientsResponseClient::from(...), $attributes),
        );
    }
}
