<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum HostMessageMode: int
{
    /**
     * Don't display anything.
     */
    case None = 0;

    /**
     * Display message in chat log.
     */
    case Log = 1;

    /**
     * Display message in a modal dialog.
     */
    case Modal = 2;

    /**
     * Display message in a modal dialog and close connection.
     */
    case ModalQuit = 3;
}
