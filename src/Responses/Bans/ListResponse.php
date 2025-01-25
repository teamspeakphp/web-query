<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Bans;

final class ListResponse
{
    /**
     * @param  list<ListResponseBan>  $bans
     */
    private function __construct(public array $bans) {}

    /**
     * Create a new response from the given attributes.
     *
     * @param  list<array{banid: string, created: string, duration: string, enforcements: string, invokercldbid: string, invokername: string, invokeruid: string, ip: string, lastnickname: string, mytsid: string, name: string, reason: string, uid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): ListResponseBan => ListResponseBan::from($result), $attributes)
        );
    }
}
