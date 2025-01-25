<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts;

/**
 * @internal
 */
interface StringableContract
{
    /**
     * Return the value as string.
     */
    public function toString(): string;
}
