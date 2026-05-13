<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelPermissions;

final readonly class ListForClientResponse
{
    /**
     * @param  list<ListForClientResponsePermission>  $permissions
     */
    private function __construct(public array $permissions) {}

    /**
     * @param  list<array{cid: string, cldbid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListForClientResponsePermission::from(...), $attributes),
        );
    }
}
