<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

final readonly class CreateResponse
{
    private function __construct(public int $id) {}

    /**
     * Create a new response from the given attributes.
     *
     * @param  array{0: array{cid: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self((int) $attributes[0]['cid']);
    }
}
