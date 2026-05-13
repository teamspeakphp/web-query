<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class OverviewResponse
{
    /**
     * @param  list<OverviewResponsePermission>  $permissions
     */
    private function __construct(
        public array $permissions,
    ) {}

    /**
     * @param  list<array{t: string, id1: string, id2: string, p: string, v: string, n: string, s: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(OverviewResponsePermission::from(...), $attributes),
        );
    }
}
