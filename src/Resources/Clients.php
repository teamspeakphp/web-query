<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ClientsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Enums\ReasonIdentifier;
use TeamSpeak\WebQuery\Exceptions\NotFoundException;
use TeamSpeak\WebQuery\Responses\Clients\FindResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetDbIdFromUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetIdsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetNameFromDbIdResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetNameFromUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\InfoResponse;
use TeamSpeak\WebQuery\Responses\Clients\ListResponse;
use TeamSpeak\WebQuery\Responses\Clients\SetServerQueryLoginResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Clients implements ClientsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of clients online on a virtual server including their ID, nickname, status flags, etc.
     *
     * The output can be modified using several command options.
     * Please note that the output will only contain clients, which are currently
     * in channels you can subscribe to.
     */
    public function list(bool $uid = false, bool $away = false, bool $voice = false, bool $times = false, bool $groups = false, bool $info = false, bool $country = false, bool $ip = false, bool $badges = false): ListResponse
    {
        $payload = new Payload(
            command: Command::ClientList,
            options: ['uid' => $uid, 'away' => $away, 'voice' => $voice, 'times' => $times, 'groups' => $groups, 'info' => $info, 'country' => $country, 'ip' => $ip, 'badges' => $badges],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cid: string, clid: string, client_away?: string, client_away_message?: string, client_badges?: string, client_channel_group_id?: string, client_channel_group_inherited_channel_id?: string, client_country?: string, client_created?: string, client_database_id: string, client_flag_talking?: string, client_idle_time?: string, client_input_hardware?: string, client_input_muted?: string, client_is_channel_commander?: string, client_is_priority_speaker?: string, client_is_recording?: string, client_is_talker?: string, client_lastconnected?: string, client_nickname: string, client_output_hardware?: string, client_output_muted?: string, client_platform?: string, client_servergroups?: string, client_talk_power?: string, client_type: string, client_unique_identifier?: string, client_version?: string, connection_client_ip?: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Displays detailed configuration information about a client including unique ID, nickname, client version, etc.
     */
    public function info(int $id): InfoResponse
    {
        $payload = new Payload(
            command: Command::ClientInfo,
            parameters: ['clid' => $id],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cid: string, client_away: string, client_away_message: string, client_badges: string, client_base64HashClientUID: string, client_channel_group_id: string, client_channel_group_inherited_channel_id: string, client_country: string, client_created: string, client_database_id: string, client_default_channel: string, client_default_token: string, client_description: string, client_flag_avatar: string, client_icon_id: string, client_idle_time: string, client_input_hardware: string, client_input_muted: string, client_integrations: string, client_is_channel_commander: string, client_is_priority_speaker: string, client_is_recording: string, client_is_talker: string, client_lastconnected: string, client_login_name: string, client_meta_data: string, client_month_bytes_downloaded: string, client_month_bytes_uploaded: string, client_myteamspeak_avatar: string, client_myteamspeak_id: string, client_needed_serverquery_view_power: string, client_nickname: string, client_nickname_phonetic: string, client_output_hardware: string, client_output_muted: string, client_outputonly_muted: string, client_platform: string, client_security_hash: string, client_servergroups: string, client_signed_badges: string, client_talk_power: string, client_talk_request: string, client_talk_request_msg: string, client_total_bytes_downloaded: string, client_total_bytes_uploaded: string, client_totalconnections: string, client_type: string, client_unique_identifier: string, client_version: string, client_version_sign: string, connection_bandwidth_received_last_minute_total: string, connection_bandwidth_received_last_second_total: string, connection_bandwidth_sent_last_minute_total: string, connection_bandwidth_sent_last_second_total: string, connection_bytes_received_total: string, connection_bytes_sent_total: string, connection_client_ip: string, connection_connected_time: string, connection_filetransfer_bandwidth_received: string, connection_filetransfer_bandwidth_sent: string, connection_packets_received_total: string, connection_packets_sent_total: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client not found.');
        }

        return InfoResponse::from($response->body());
    }

    /**
     * Displays a list of clients matching a given name pattern.
     */
    public function find(string $pattern): FindResponse
    {
        $payload = new Payload(
            command: Command::ClientFind,
            parameters: ['pattern' => $pattern],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{clid: string, client_nickname: string}>> $response */
        $response = $this->transporter->request($payload);

        return FindResponse::from($response->body());
    }

    /**
     * Changes a clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
     * @param  array<string, string>  $properties
     */
    public function edit(int $id, array $properties): void
    {
        $payload = new Payload(
            command: Command::ClientEdit,
            parameters: [
                ...$properties,
                'clid' => $id,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Changes a clients description.
     */
    public function editDescription(int $id, string $description): void
    {
        $this->edit($id, ['client_description' => $description]);
    }

    /**
     * Displays all client IDs matching the unique identifier specified by unique identifier.
     */
    public function getIds(string $uid): GetIdsResponse
    {
        $payload = new Payload(
            command: Command::ClientGetIds,
            parameters: ['cluid' => $uid],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{clid: string, name: string, cluid: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetIdsResponse::from($response->body());
    }

    /**
     * Displays the database ID matching the unique identifier.
     */
    public function getDbIdFromUid(string $uid): GetDbIdFromUidResponse
    {
        $payload = new Payload(
            command: Command::ClientGetDbIdFromUid,
            parameters: ['cluid' => $uid],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cluid: string, cldbid: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client not found.');
        }

        return GetDbIdFromUidResponse::from($response->body());
    }

    /**
     * Displays the database ID and nickname matching the unique identifier.
     */
    public function getNameFromUid(string $uid): GetNameFromUidResponse
    {
        $payload = new Payload(
            command: Command::ClientGetNameFromUid,
            parameters: ['cluid' => $uid],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cluid: string, name:string, cldbid: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client not found.');
        }

        return GetNameFromUidResponse::from($response->body());
    }

    /**
     * Displays the unique identifier matching the client ID.
     */
    public function getUid(int $id): GetUidResponse
    {
        $payload = new Payload(
            command: Command::ClientGetUidFromClId,
            parameters: ['clid' => $id],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{clid: string, cluid:string, nickname: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client not found.');
        }

        return GetUidResponse::from($response->body());
    }

    /**
     * Displays the unique identifier and nickname matching the database ID.
     */
    public function getNameFromDbId(int $dbId): GetNameFromDbIdResponse
    {
        $payload = new Payload(
            command: Command::ClientGetNameFromDbId,
            parameters: ['cldbid' => $dbId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cluid: string, name:string, cldbid: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client not found.');
        }

        return GetNameFromDbIdResponse::from($response->body());
    }

    /**
     * Updates your own ServerQuery login credentials using a specified username.
     *
     * The password will be auto-generated.
     */
    public function setServerQueryLogin(string $loginName): SetServerQueryLoginResponse
    {
        $payload = new Payload(
            command: Command::ClientSetServerQueryLogin,
            parameters: ['client_login_name' => $loginName],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{client_login_password: string}}|array{}> $response */
        $response = $this->transporter->request($payload);

        if ($response->body() === []) {
            throw new NotFoundException('Client with the login name not found.');
        }

        return SetServerQueryLoginResponse::from($response->body());
    }

    /**
     * Change your ServerQuery clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
     * @param  array<string, string>  $properties
     */
    public function update(array $properties): void
    {
        $payload = new Payload(
            command: Command::ClientUpdate,
            parameters: $properties,
        );

        $this->transporter->request($payload);
    }

    /**
     * Change your ServerQuery clients nickname.
     */
    public function updateNickname(string $nickname): void
    {
        $this->update(['client_nickname' => $nickname]);
    }

    /**
     * Moves one or more clients to the channel with ID.
     *
     * If the target channel has a password, it needs to be specified with cpw.
     * If the channel has no password, the parameter can be omitted.
     *
     * @param  list<int>|int  $id
     */
    public function move(array|int $id, int $channelId, ?string $password = null): void
    {
        $payload = new Payload(
            command: Command::ClientMove,
            parameters: ['clid' => $id, 'cid' => $channelId, 'cpw' => $password],
        );

        $this->transporter->request($payload);
    }

    /**
     * Kicks one or more clients from their currently joined channel or from the server.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kick(array|int $id, ReasonIdentifier $type, ?string $reason = null): void
    {
        $payload = new Payload(
            command: Command::ClientKick,
            parameters: ['clid' => $id, 'reasonid' => $type->value, 'reasonmsg' => $reason],
        );

        $this->transporter->request($payload);
    }

    /**
     * Kicks one or more clients from their currently joined channel.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kickFromChannel(array|int $id, ?string $reason = null): void
    {
        $this->kick($id, ReasonIdentifier::KickChannel, $reason);
    }

    /**
     * Kicks one or more clients from the server.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kickFromServer(array|int $id, ?string $reason = null): void
    {
        $this->kick($id, ReasonIdentifier::KickServer, $reason);
    }

    /**
     * Sends a poke message to the client.
     */
    public function poke(int $id, string $message): void
    {
        $payload = new Payload(
            command: Command::ClientPoke,
            parameters: ['clid' => $id, 'msg' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of permissions defined for a client.
     */
    public function getPermissions(int $databaseId, bool $name = false): GetPermissionsResponse
    {
        $payload = new Payload(
            command: Command::ClientPermList,
            parameters: ['cldbid' => $databaseId],
            options: ['permsid' => $name],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetPermissionsResponse::from($response->body());
    }

    /**
     * Adds a set of specified permission to a client.
     *
     * A permission can be specified by ID or name.
     */
    public function addPermission(int $databaseId, string|int $id, int $value, bool $skip = false): void
    {
        $payload = new Payload(
            command: Command::ClientAddPerm,
            parameters: [
                'cldbid' => $databaseId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
                'permvalue' => $value,
                'permskip' => $skip,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a set of specified permission from a client.
     *
     * A permission can be specified by ID or name.
     */
    public function deletePermission(int $databaseId, string|int $id): void
    {
        $payload = new Payload(
            command: Command::ClientDelPerm,
            parameters: [
                'cldbid' => $databaseId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        $this->transporter->request($payload);
    }
}
