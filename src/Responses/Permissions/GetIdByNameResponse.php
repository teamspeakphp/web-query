<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class GetIdByNameResponse
{
    private function __construct(
        public int $id,
        public string $name,
    ) {}

    /**
     * @param  array{0: array{permid: string, permsid: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['permid'],
            $attributes[0]['permsid'],
        );
    }
}
