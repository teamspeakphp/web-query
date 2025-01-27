<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class GetIdsResponseClient
{
    private function __construct(
        public int $id,
        public string $nickname,
        public string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{clid: string, name: string, cluid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['clid'],
            $attributes['name'],
            $attributes['cluid'],
        );
    }
}
