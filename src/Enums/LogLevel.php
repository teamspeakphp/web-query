<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum LogLevel: int
{
    /**
     * Everything that terrible.
     */
    case Error = 1;

    /**
     * Everything that might bad.
     */
    case Warning = 2;

    /**
     * Output that might help find a problem.
     */
    case Debug = 3;

    /**
     * Informational output.
     */
    case Info = 4;
}
