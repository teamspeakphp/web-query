<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class CreateSnapshotResponse
{
    private function __construct(
        public string $hash,
        public string $data,
    ) {}

    /**
     * @param  array{0: array{hash: string, virtualserver_snapshot: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['hash'],
            $attributes[0]['virtualserver_snapshot'],
        );
    }
}
