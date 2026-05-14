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

    /**
     * Writes an error entry into the server log.
     */
    public function error(string $message): void;

    /**
     * Writes a warning entry into the server log.
     */
    public function warning(string $message): void;

    /**
     * Writes a debug entry into the server log.
     */
    public function debug(string $message): void;

    /**
     * Writes an info entry into the server log.
     */
    public function info(string $message): void;
}
