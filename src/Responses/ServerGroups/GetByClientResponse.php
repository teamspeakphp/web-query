<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class GetByClientResponse
{
    /**
     * @param  list<GetByClientResponseGroup>  $groups
     */
    private function __construct(public array $groups) {}

    /**
     * @param  list<array{name: string, sgid: string, cldbid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): GetByClientResponseGroup => GetByClientResponseGroup::from($result), $attributes),
        );
    }
}
