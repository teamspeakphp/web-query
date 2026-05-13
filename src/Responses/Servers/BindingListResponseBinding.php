<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class BindingListResponseBinding
{
    private function __construct(public string $ip) {}

    /**
     * @param  array{ip: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['ip']);
    }
}
