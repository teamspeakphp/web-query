<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class FindResponse
{
    /**
     * @param  list<FindResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{clid: string, client_nickname: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): FindResponseClient => FindResponseClient::from($result), $attributes)
        );
    }
}
