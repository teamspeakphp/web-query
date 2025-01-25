<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\DatabaseClients;

final readonly class FindResponse
{
    /**
     * @param  array<int, FindResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{cldbid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): FindResponseClient => FindResponseClient::from($result), $attributes),
        );
    }
}
