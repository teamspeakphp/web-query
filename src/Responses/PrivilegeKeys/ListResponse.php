<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\PrivilegeKeys;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseKey>  $keys
     */
    private function __construct(
        public array $keys,
    ) {}

    /**
     * @param  list<array{token: string, token_type: string, token_id1: string, token_id2: string, token_description: string, token_created: string, token_customset?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListResponseKey::from(...), $attributes),
        );
    }
}
