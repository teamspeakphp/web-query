<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum LogLevel: int
{
    /**
     * Everything that terrible.
     */
    case Error = 0;

    /**
     * Everything that might bad.
     */
    case Warning = 1;

    /**
     * Output that might help find a problem.
     */
    case Debug = 2;

    /**
     * Informational output.
     */
    case Info = 3;
}
