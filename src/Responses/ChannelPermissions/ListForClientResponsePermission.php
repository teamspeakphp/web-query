<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ChannelPermissions;

final readonly class ListForClientResponsePermission
{
    private function __construct(
        public int $channelId,
        public int $clientDatabaseId,
        public ?int $id,
        public ?string $name,
        public bool $negated,
        public bool $skip,
        public int $value,
    ) {}

    /**
     * @param  array{cid: string, cldbid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cid'],
            (int) $attributes['cldbid'],
            isset($attributes['permid']) ? (int) $attributes['permid'] : null,
            $attributes['permsid'] ?? null,
            (bool) $attributes['permnegated'],
            (bool) $attributes['permskip'],
            (int) $attributes['permvalue'],
        );
    }
}
