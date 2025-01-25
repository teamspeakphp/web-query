<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum CodecEncryptionMode: int
{
    /**
     * Configure per channel.
     */
    case Individual = 0;

    /**
     * Globally disabled.
     */
    case Disabled = 1;

    /**
     * Globally enabled.
     */
    case Enabled = 2;
}
