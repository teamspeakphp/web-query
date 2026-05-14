<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponsePermission>  $permissions
     */
    private function __construct(
        public array $permissions,
    ) {}

    /**
     * @param  list<array{permid: string, permname: string, permdesc: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListResponsePermission::from(...), $attributes),
        );
    }
}
