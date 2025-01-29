<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetPermissionsResponsePermission
{
    private function __construct(
        public int $serverGroupId,
        public ?int $id,
        public ?string $name,
        public bool $negated,
        public bool $skip,
        public ?int $value,
    ) {}

    /**
     * @param  array{sgid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['sgid'],
            isset($attributes['permid']) ? (int) $attributes['permid'] : null,
            $attributes['permsid'] ?? null,
            (bool) $attributes['permnegated'],
            (bool) $attributes['permskip'],
            (int) $attributes['permvalue'],
        );
    }
}
