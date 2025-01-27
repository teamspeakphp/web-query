<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class FindResponseClient
{
    private function __construct(
        public int $id,
        public string $nickname,
    ) {}

    /**
     * @param  array{clid: string, client_nickname: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['clid'],
            $attributes['client_nickname'],
        );
    }
}
