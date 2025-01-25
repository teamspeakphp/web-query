<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\DatabaseClients;

final readonly class FindResponseClient
{
    private function __construct(public int $databaseId) {}

    /**
     * Create a new client from the given attributes.
     *
     * @param  array{cldbid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self((int) $attributes['cldbid']);
    }
}
