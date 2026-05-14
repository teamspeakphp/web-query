<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\PrivilegeKeys;

final readonly class ListResponseKey
{
    private function __construct(
        public string $token,
        public int $type,
        public int $id1,
        public int $id2,
        public string $description,
        public int $createdAt,
        public string $customSet,
    ) {}

    /**
     * @param  array{token: string, token_type: string, token_id1: string, token_id2: string, token_description: string, token_created: string, token_customset?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['token'],
            (int) $attributes['token_type'],
            (int) $attributes['token_id1'],
            (int) $attributes['token_id2'],
            $attributes['token_description'],
            (int) $attributes['token_created'],
            $attributes['token_customset'] ?? '',
        );
    }
}
