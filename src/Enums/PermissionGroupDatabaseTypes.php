<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum PermissionGroupDatabaseTypes: int
{
    /**
     * Template group (used for new virtual servers).
     */
    case Template = 0;

    /**
     * A regular group (used for regular clients).
     */
    case Regular = 1;

    /**
     * Global query group (used for ServerQuery clients).
     */
    case Query = 2;
}
