<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class ListResponsePermission
{
    private function __construct(
        public int $id,
        public string $name,
        public string $description,
        public int $type,
        public bool $isFlag,
    ) {}

    /**
     * @param  array{permid: string, permname: string, permdesc: string, permtype: string, permisflag: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['permid'],
            $attributes['permname'],
            $attributes['permdesc'],
            (int) $attributes['permtype'],
            (bool) $attributes['permisflag'],
        );
    }
}
