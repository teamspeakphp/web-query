<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\CustomProperties;

final readonly class InfoResponse
{
    /**
     * @param  list<InfoResponseProperty>  $properties
     */
    private function __construct(
        public array $properties,
    ) {}

    /**
     * @param  list<array{cldbid: string, ident: string, value: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(InfoResponseProperty::from(...), $attributes),
        );
    }
}
