<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseClient>  $clients
     */
    private function __construct(public array $clients) {}

    /**
     * @param  list<array{cid: string, clid: string, client_away?: string, client_away_message?: string, client_badges?: string, client_channel_group_id?: string, client_channel_group_inherited_channel_id?: string, client_country?: string, client_created?: string, client_database_id: string, client_flag_talking?: string, client_idle_time?: string, client_input_hardware?: string, client_input_muted?: string, client_is_channel_commander?: string, client_is_priority_speaker?: string, client_is_recording?: string, client_is_talker?: string, client_lastconnected?: string, client_nickname: string, client_output_hardware?: string, client_output_muted?: string, client_platform?: string, client_servergroups?: string, client_talk_power?: string, client_type: string, client_unique_identifier?: string, client_version?: string, connection_client_ip?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): ListResponseClient => ListResponseClient::from($result), $attributes)
        );
    }
}
