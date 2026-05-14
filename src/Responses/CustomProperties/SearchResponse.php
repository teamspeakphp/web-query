<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\CustomProperties;

final readonly class SearchResponse
{
    /**
     * @param  list<SearchResponseResult>  $results
     */
    private function __construct(
        public array $results,
    ) {}

    /**
     * @param  list<array{cldbid: string, ident: string, value: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(SearchResponseResult::from(...), $attributes),
        );
    }
}
