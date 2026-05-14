<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class ListResponseServer
{
    private function __construct(
        public int $id,
        public string $status,
        public string $name,
        public int $port,
        public ?int $clientsOnline,
        public ?int $queryClientsOnline,
        public ?int $maxClients,
        public ?int $uptime,
        public ?bool $autostart,
        public ?string $machineId,
        public ?string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{virtualserver_id: string, virtualserver_status: string, virtualserver_name: string, virtualserver_port: string, virtualserver_clientsonline?: string, virtualserver_queryclientsonline?: string, virtualserver_maxclients?: string, virtualserver_uptime?: string, virtualserver_autostart?: string, virtualserver_machine_id?: string, virtualserver_unique_identifier?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['virtualserver_id'],
            $attributes['virtualserver_status'],
            $attributes['virtualserver_name'],
            (int) $attributes['virtualserver_port'],
            isset($attributes['virtualserver_clientsonline']) ? (int) $attributes['virtualserver_clientsonline'] : null,
            isset($attributes['virtualserver_queryclientsonline']) ? (int) $attributes['virtualserver_queryclientsonline'] : null,
            isset($attributes['virtualserver_maxclients']) ? (int) $attributes['virtualserver_maxclients'] : null,
            isset($attributes['virtualserver_uptime']) ? (int) $attributes['virtualserver_uptime'] : null,
            isset($attributes['virtualserver_autostart']) ? (bool) $attributes['virtualserver_autostart'] : null,
            $attributes['virtualserver_machine_id'] ?? null,
            $attributes['virtualserver_unique_identifier'] ?? null,
        );
    }
}
