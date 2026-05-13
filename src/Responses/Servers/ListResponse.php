<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseServer>  $servers
     */
    private function __construct(public array $servers) {}

    /**
     * @param  list<array{sid: string, virtualserver_status: string, virtualserver_clientsonline: string, virtualserver_queryclientsonline: string, virtualserver_maxclients: string, virtualserver_uptime: string, virtualserver_name: string, virtualserver_autostart: string, virtualserver_machine_id: string, virtualserver_port: string, virtualserver_unique_identifier?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(ListResponseServer::from(...), $attributes),
        );
    }
}
