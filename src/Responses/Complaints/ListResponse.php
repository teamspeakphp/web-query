<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Complaints;

final class ListResponse
{
    /**
     * @param  list<ListResponseComplaint>  $complaints
     */
    private function __construct(public array $complaints) {}

    /**
     * @param  list<array{tcldbid: string, tclname: string, fcldbid: string, fclname: string, message: string, timestamp: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListResponseComplaint::from(...), $attributes),
        );
    }
}
