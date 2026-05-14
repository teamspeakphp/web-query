<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum PrivilegeKeyType: int
{
    /**
     * Grants membership to a server group.
     */
    case ServerGroup = 0;

    /**
     * Grants membership to a channel group in a specific channel.
     */
    case ChannelGroup = 1;
}
