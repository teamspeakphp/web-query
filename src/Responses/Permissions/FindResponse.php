<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Permissions;

final readonly class FindResponse
{
    /**
     * @param  list<FindResponseAssignment>  $assignments
     */
    private function __construct(
        public array $assignments,
    ) {}

    /**
     * @param  list<array{t: string, id1: string, id2: string, p: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(FindResponseAssignment::from(...), $attributes),
        );
    }
}
