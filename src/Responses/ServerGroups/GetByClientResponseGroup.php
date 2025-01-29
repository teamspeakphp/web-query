<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetByClientResponseGroup
{
    private function __construct(
        public string $name,
        public int $id,
        public int $clientDatabaseId,
    ) {}

    /**
     * @param  array{name: string, sgid: string, cldbid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            (int) $attributes['sgid'],
            (int) $attributes['cldbid'],
        );
    }
}
