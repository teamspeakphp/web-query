<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class BindingListResponse
{
    /**
     * @param  list<BindingListResponseBinding>  $bindings
     */
    private function __construct(public array $bindings) {}

    /**
     * @param  list<array{ip: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(BindingListResponseBinding::from(...), $attributes),
        );
    }
}
