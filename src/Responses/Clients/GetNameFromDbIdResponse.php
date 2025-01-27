<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class GetNameFromDbIdResponse
{
    private function __construct(
        public int $databaseId,
        public string $name,
        public string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{0: array{cluid: string, name:string, cldbid: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['cldbid'],
            $attributes[0]['name'],
            $attributes[0]['cluid'],
        );
    }
}
