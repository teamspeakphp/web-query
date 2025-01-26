<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Messages;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseMessage>  $messages
     */
    private function __construct(
        public array $messages,
    ) {}

    /**
     * @param  list<array{msgid: string, cluid: string, subject: string, timestamp: string, flag_read: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $attributes): ListResponseMessage => ListResponseMessage::from($attributes), $attributes),
        );
    }
}
