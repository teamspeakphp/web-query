<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class ListResponseServer
{
    private function __construct(
        public int $id,
        public string $status,
        public int $clientsOnline,
        public int $queryClientsOnline,
        public int $maxClients,
        public int $uptime,
        public string $name,
        public bool $autostart,
        public string $machineId,
        public int $port,
        public ?string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{sid: string, virtualserver_status: string, virtualserver_clientsonline: string, virtualserver_queryclientsonline: string, virtualserver_maxclients: string, virtualserver_uptime: string, virtualserver_name: string, virtualserver_autostart: string, virtualserver_machine_id: string, virtualserver_port: string, virtualserver_unique_identifier?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['sid'],
            $attributes['virtualserver_status'],
            (int) $attributes['virtualserver_clientsonline'],
            (int) $attributes['virtualserver_queryclientsonline'],
            (int) $attributes['virtualserver_maxclients'],
            (int) $attributes['virtualserver_uptime'],
            $attributes['virtualserver_name'],
            (bool) $attributes['virtualserver_autostart'],
            $attributes['virtualserver_machine_id'],
            (int) $attributes['virtualserver_port'],
            $attributes['virtualserver_unique_identifier'] ?? null,
        );
    }
}
