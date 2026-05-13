<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class OverviewResponsePermission
{
    private function __construct(
        public int $type,
        public int $id1,
        public int $id2,
        public int $permId,
        public int $value,
        public bool $negated,
        public bool $skip,
    ) {}

    /**
     * @param  array{t: string, id1: string, id2: string, p: string, v: string, n: string, s: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['t'],
            (int) $attributes['id1'],
            (int) $attributes['id2'],
            (int) $attributes['p'],
            (int) $attributes['v'],
            (bool) $attributes['n'],
            (bool) $attributes['s'],
        );
    }
}
