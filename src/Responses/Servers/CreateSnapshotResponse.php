<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class CreateSnapshotResponse
{
    private function __construct(
        public string $data,
        public string $version,
        public ?string $salt,
    ) {}

    /**
     * @param  array{0: array{data: string, version: string, salt?: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['data'],
            $attributes[0]['version'],
            $attributes[0]['salt'] ?? null,
        );
    }
}
