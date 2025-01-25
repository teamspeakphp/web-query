<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum TokenType: int
{
    /**
     * Server group token.
     */
    case ServerGroup = 0;

    /**
     * Channel group token.
     */
    case ChannelGroup = 1;
}
