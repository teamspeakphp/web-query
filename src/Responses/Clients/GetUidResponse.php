<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class GetUidResponse
{
    private function __construct(
        public int $id,
        public string $name,
        public string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{0: array{clid: string, cluid:string, nickname: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['clid'],
            $attributes[0]['nickname'],
            $attributes[0]['cluid'],
        );
    }
}
