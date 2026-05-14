<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\PrivilegeKeys;

final readonly class AddResponse
{
    private function __construct(
        public string $token,
    ) {}

    /**
     * @param  array{0: array{token: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['token'],
        );
    }
}
