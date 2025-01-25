<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum ReasonIdentifier: int
{
    /**
     * Kick client from a channel.
     */
    case KickChannel = 4;

    /**
     * Kick client from a server.
     */
    case KickServer = 5;
}
