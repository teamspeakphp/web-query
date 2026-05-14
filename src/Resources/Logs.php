<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\LogsContract;
use TeamSpeak\WebQuery\Enums\LogLevel;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Logs\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Logs implements LogsContract
{
    use Concerns\Transportable;

    /**
     * Displays a specified number of entries from the server log.
     */
    public function list(?int $lines = null, bool $reverse = false, bool $instance = false, ?int $beginPos = null): ListResponse
    {
        $payload = new Payload(
            command: Command::LogView,
            parameters: ['lines' => $lines, 'reverse' => $reverse ? 1 : null, 'instance' => $instance ? 1 : null, 'begin_pos' => $beginPos],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{l: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Writes a custom entry into the server log.
     */
    public function add(LogLevel $level, string $message): void
    {
        $payload = new Payload(
            command: Command::LogAdd,
            parameters: ['loglevel' => $level->value, 'logmsg' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Writes an error entry into the server log.
     */
    public function error(string $message): void
    {
        $this->add(LogLevel::Error, $message);
    }

    /**
     * Writes a warning entry into the server log.
     */
    public function warning(string $message): void
    {
        $this->add(LogLevel::Warning, $message);
    }

    /**
     * Writes a debug entry into the server log.
     */
    public function debug(string $message): void
    {
        $this->add(LogLevel::Debug, $message);
    }

    /**
     * Writes an info entry into the server log.
     */
    public function info(string $message): void
    {
        $this->add(LogLevel::Info, $message);
    }
}
