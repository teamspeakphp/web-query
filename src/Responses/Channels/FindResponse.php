<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

final readonly class FindResponse
{
    /**
     * @param  list<FindResponseChannel>  $channels
     */
    private function __construct(public array $channels) {}

    /**
     * @param  list<array{cid: string, channel_name: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): FindResponseChannel => FindResponseChannel::from($result), $attributes)
        );
    }
}
