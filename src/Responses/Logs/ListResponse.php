<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Logs;

final class ListResponse
{
    /**
     * @param  list<ListResponseLog>  $logs
     */
    private function __construct(public array $logs) {}

    /**
     * @param  list<array{l: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListResponseLog::from(...), $attributes)
        );
    }
}
