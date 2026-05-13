<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelGroups;

final readonly class GetPermissionsResponse
{
    /**
     * @param  list<GetPermissionsResponsePermission>  $permissions
     */
    private function __construct(public array $permissions) {}

    /**
     * @param  list<array{cgid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(GetPermissionsResponsePermission::from(...), $attributes),
        );
    }
}
