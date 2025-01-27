<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class GetPermissionsResponse
{
    /**
     * @param  list<GetPermissionsResponsePermission>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{cldbid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): GetPermissionsResponsePermission => GetPermissionsResponsePermission::from($result), $attributes)
        );
    }
}
