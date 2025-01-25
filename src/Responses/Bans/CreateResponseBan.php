<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Bans;

final class CreateResponseBan
{
    private function __construct(public int $id) {}

    /**
     * Create a new bank from the given attributes.
     *
     * @param  array{banid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self((int) $attributes['banid']);
    }
}
