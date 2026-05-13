<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class GetResponse
{
    private function __construct(
        public int $id,
        public string $name,
        public int $value,
    ) {}

    /**
     * @param  array{0: array{permid: string, permsid: string, permvalue: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['permid'],
            $attributes[0]['permsid'],
            (int) $attributes[0]['permvalue'],
        );
    }
}
