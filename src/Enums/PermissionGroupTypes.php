<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum PermissionGroupTypes: int
{
    /**
     * Server group permission.
     */
    case ServerGroup = 0;

    /**
     * Client specific permission.
     */
    case GlobalClient = 1;

    /**
     * Channel specific permission.
     */
    case Channel = 2;

    /**
     * Channel group permission.
     */
    case ChannelGroup = 3;

    /**
     * Channel-client specific permission.
     */
    case ChannelClient = 4;
}
