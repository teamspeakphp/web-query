<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class IdGetByPortResponse
{
    private function __construct(public int $serverId) {}

    /**
     * @param  array{0: array{server_id: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self((int) $attributes[0]['server_id']);
    }
}
