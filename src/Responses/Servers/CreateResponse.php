<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class CreateResponse
{
    private function __construct(
        public int $id,
        public int $port,
        public ?string $token,
    ) {}

    /**
     * @param  array{0: array{sid: string, virtualserver_port: string, token?: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['sid'],
            (int) $attributes[0]['virtualserver_port'],
            $attributes[0]['token'] ?? null,
        );
    }
}
