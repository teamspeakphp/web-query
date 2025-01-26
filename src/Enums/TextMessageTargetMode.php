<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum TextMessageTargetMode: int
{
    /**
     * Target a client.
     */
    case Client = 1;

    /**
     * Target a channel.
     */
    case Channel = 2;

    /**
     * Target a virtual server.
     */
    case Server = 3;
}
