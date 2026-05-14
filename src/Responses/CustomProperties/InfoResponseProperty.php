<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\CustomProperties;

final readonly class InfoResponseProperty
{
    private function __construct(
        public int $clientDatabaseId,
        public string $ident,
        public string $value,
    ) {}

    /**
     * @param  array{cldbid: string, ident: string, value: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cldbid'],
            $attributes['ident'],
            $attributes['value'],
        );
    }
}
