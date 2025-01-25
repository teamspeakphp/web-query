<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum TextMessageTargetMode: int
{
    /**
     * Target a client.
     */
    case Client = 0;

    /**
     * Target a channel.
     */
    case Channel = 1;

    /**
     * Target a virtual server.
     */
    case Server = 2;
}
