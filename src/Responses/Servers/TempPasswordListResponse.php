<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class TempPasswordListResponse
{
    /**
     * @param  list<TempPasswordListResponsePassword>  $passwords
     */
    private function __construct(public array $passwords) {}

    /**
     * @param  list<array{nickname: string, uid: string, desc: string, pw_clear: string, start: string, end: string, tcid: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(TempPasswordListResponsePassword::from(...), $attributes),
        );
    }
}
