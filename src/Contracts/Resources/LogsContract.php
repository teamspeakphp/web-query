<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Enums\LogLevel;
use TeamSpeak\WebQuery\Responses\Logs\ListResponse;

interface LogsContract
{
    /**
     * Displays a specified number of entries from the server log.
     */
    public function list(?int $lines = null, bool $reverse = false, bool $instance = false, ?int $beginPos = null): ListResponse;

    /**
     * Writes a custom entry into the server log.
     */
    public function add(LogLevel $level, string $message): void;
}
