<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

final readonly class FindResponseChannel
{
    private function __construct(
        public int $id,
        public string $name,
    ) {}

    /**
     * @param  array{cid: string, channel_name: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cid'],
            $attributes['channel_name'],
        );
    }
}
