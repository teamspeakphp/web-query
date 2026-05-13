<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelGroups;

final readonly class CopyResponse
{
    private function __construct(public ?int $id) {}

    /**
     * @param  array{0?: array{cgid: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            isset($attributes[0]) ? (int) $attributes[0]['cgid'] : null,
        );
    }
}
