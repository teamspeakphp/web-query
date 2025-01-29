<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseGroup>  $groups
     */
    private function __construct(public array $groups) {}

    /**
     * @param  list<array{iconid: string, n_member_addp: string, n_member_removep: string, n_modifyp: string, name: string, namemode: string, savedb: string, sgid: string, sortid: string, type: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): ListResponseGroup => ListResponseGroup::from($result), $attributes),
        );
    }
}
