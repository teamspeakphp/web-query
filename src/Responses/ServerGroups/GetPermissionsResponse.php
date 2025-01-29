<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetPermissionsResponse
{
    /**
     * @param  list<GetPermissionsResponsePermission>  $permissions
     */
    private function __construct(public array $permissions) {}

    /**
     * @param  list<array{sgid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): GetPermissionsResponsePermission => GetPermissionsResponsePermission::from($result), $attributes),
        );
    }
}
