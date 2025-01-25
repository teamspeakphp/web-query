<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum HostBannerMode: int
{
    /**
     * Do not adjust.
     */
    case NoAdjust = 0;

    /**
     * Adjust but ignore aspect ratio (like TeamSpeak 2).
     */
    case IgnoreAspect = 1;

    /**
     * Adjust and keep aspect ratio.
     */
    case KeepAspect = 2;
}
