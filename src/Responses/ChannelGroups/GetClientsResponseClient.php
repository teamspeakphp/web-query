<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelGroups;

final readonly class GetClientsResponseClient
{
    private function __construct(
        public int $channelId,
        public int $clientDatabaseId,
        public int $channelGroupId,
    ) {}

    /**
     * @param  array{cid: string, cldbid: string, cgid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cid'],
            (int) $attributes['cldbid'],
            (int) $attributes['cgid'],
        );
    }
}
