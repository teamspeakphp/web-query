<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetClientsResponseClient
{
    private function __construct(
        public int $databaseId,
    ) {}

    /**
     * @param  array{cldbid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cldbid'],
        );
    }
}
