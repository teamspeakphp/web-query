<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Bans;

final class CreateResponse
{
    /**
     * @param  list<CreateResponseBan>  $bans
     */
    private function __construct(public array $bans) {}

    /**
     * Create a new response from the given attributes.
     *
     * @param  list<array{banid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): CreateResponseBan => CreateResponseBan::from($result), $attributes)
        );
    }
}
