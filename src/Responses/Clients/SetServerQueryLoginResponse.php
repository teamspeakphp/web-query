<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class SetServerQueryLoginResponse
{
    private function __construct(public string $password) {}

    /**
     * @param  array{0: array{client_login_password: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['client_login_password'],
        );
    }
}
