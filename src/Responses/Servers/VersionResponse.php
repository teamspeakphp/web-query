<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class VersionResponse
{
    private function __construct(
        public string $version,
        public string $build,
        public string $platform,
    ) {}

    /**
     * @param  array{0: array{version: string, build: string, platform: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['version'],
            $attributes[0]['build'],
            $attributes[0]['platform'],
        );
    }
}
