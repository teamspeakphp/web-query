<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\ServerGroups;

final readonly class AddResponse
{
    private function __construct(public int $id) {}

    /**
     * @param  array{0: array{sgid: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self((int) $attributes[0]['sgid']);
    }
}
