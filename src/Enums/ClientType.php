<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum ClientType: int
{
    /**
     * A regular client that connected via application.
     */
    case Client = 0;

    /**
     * A bot that connected via ServerQuery.
     */
    case Bot = 1;
}
