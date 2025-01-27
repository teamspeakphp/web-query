<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class GetIdsResponse
{
    /**
     * @param  list<GetIdsResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{clid: string, name: string, cluid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): GetIdsResponseClient => GetIdsResponseClient::from($result), $attributes)
        );
    }
}
