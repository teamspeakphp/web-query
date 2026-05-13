<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ServersContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Servers\BindingListResponse;
use TeamSpeak\WebQuery\Responses\Servers\ConnectionInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\CreateResponse;
use TeamSpeak\WebQuery\Responses\Servers\CreateSnapshotResponse;
use TeamSpeak\WebQuery\Responses\Servers\HostInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\IdGetByPortResponse;
use TeamSpeak\WebQuery\Responses\Servers\InfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\InstanceInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\ListResponse;
use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponse;
use TeamSpeak\WebQuery\Responses\Servers\VersionResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Servers implements ServersContract
{
    use Concerns\Transportable;

    /**
     * Displays the version information of the server including platform and build number.
     */
    public function version(): VersionResponse
    {
        $payload = new Payload(Command::Version);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{version: string, build: string, platform: string}}> $response */
        $response = $this->transporter->request($payload);

        return VersionResponse::from($response->body());
    }

    /**
     * Displays detailed configuration information about the server instance including uptime and database version.
     */
    public function hostInfo(): HostInfoResponse
    {
        $payload = new Payload(Command::HostInfo);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{instance_uptime: string, host_timestamp_utc: string, virtualservers_running_total: string, virtualservers_total_maxclients: string, virtualservers_total_clients_online: string, virtualservers_total_channels_online: string, connection_filetransfer_bandwidth_sent: string, connection_filetransfer_bandwidth_received: string, connection_filetransfer_bytes_sent_total: string, connection_filetransfer_bytes_received_total: string, connection_packets_sent_total: string, connection_bytes_sent_total: string, connection_packets_received_total: string, connection_bytes_received_total: string, connection_bandwidth_sent_last_second_total: string, connection_bandwidth_sent_last_minute_total: string, connection_bandwidth_received_last_second_total: string, connection_bandwidth_received_last_minute_total: string}}> $response */
        $response = $this->transporter->request($payload);

        return HostInfoResponse::from($response->body());
    }

    /**
     * Displays the server instance configuration including database version, default groups, and flood settings.
     */
    public function instanceInfo(): InstanceInfoResponse
    {
        $payload = new Payload(Command::InstanceInfo);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{serverinstance_database_version: string, serverinstance_filetransfer_port: string, serverinstance_max_download_total_bandwidth: string, serverinstance_max_upload_total_bandwidth: string, serverinstance_guest_serverquery_group: string, serverinstance_serverquery_flood_commands: string, serverinstance_serverquery_flood_time: string, serverinstance_serverquery_ban_time: string, serverinstance_template_serveradmin_group: string, serverinstance_template_serverdefault_group: string, serverinstance_template_channeladmin_group: string, serverinstance_template_channeldefault_group: string, serverinstance_permissions_version: string, serverinstance_pending_connections_per_ip: string}}> $response */
        $response = $this->transporter->request($payload);

        return InstanceInfoResponse::from($response->body());
    }

    /**
     * Changes the server instance configuration using given properties.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function editInstance(array $properties): void
    {
        $payload = new Payload(
            command: Command::InstanceEdit,
            parameters: $properties,
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of IP addresses used by the server instance on multi-homed machines.
     */
    public function bindingList(): BindingListResponse
    {
        $payload = new Payload(Command::BindingList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{ip: string}>> $response */
        $response = $this->transporter->request($payload);

        return BindingListResponse::from($response->body());
    }

    /**
     * Displays a list of virtual servers including their ID, status, number of clients online, etc.
     *
     * Use uid to include the unique identifier, all to include offline servers,
     * short for a short list, or onlyOffline to show only offline servers.
     */
    public function list(bool $uid = false, bool $short = false, bool $all = false, bool $onlyOffline = false): ListResponse
    {
        $payload = new Payload(
            command: Command::ServerList,
            options: ['uid' => $uid, 'short' => $short, 'all' => $all, 'onlyoffline' => $onlyOffline],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{sid: string, virtualserver_status: string, virtualserver_clientsonline: string, virtualserver_queryclientsonline: string, virtualserver_maxclients: string, virtualserver_uptime: string, virtualserver_name: string, virtualserver_autostart: string, virtualserver_machine_id: string, virtualserver_port: string, virtualserver_unique_identifier?: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Returns the ID of a virtual server by its UDP port.
     */
    public function idGetByPort(int $port): IdGetByPortResponse
    {
        $payload = new Payload(
            command: Command::ServerIdGetByPort,
            parameters: ['virtualserver_port' => $port],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{server_id: string}}> $response */
        $response = $this->transporter->request($payload);

        return IdGetByPortResponse::from($response->body());
    }

    /**
     * Deletes the virtual server specified by its ID.
     *
     * The server must be stopped before it can be deleted.
     */
    public function delete(int $id): void
    {
        $payload = new Payload(
            command: Command::ServerDelete,
            parameters: ['sid' => $id],
        );

        $this->transporter->request($payload);
    }

    /**
     * Creates a new virtual server using the given properties and returns its ID, port, and admin token.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function create(string $name, array $properties = []): CreateResponse
    {
        $payload = new Payload(
            command: Command::ServerCreate,
            parameters: [
                ...$properties,
                'virtualserver_name' => $name,
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{sid: string, virtualserver_port: string, token?: string}}> $response */
        $response = $this->transporter->request($payload);

        return CreateResponse::from($response->body());
    }

    /**
     * Starts the virtual server specified by its ID.
     */
    public function start(int $id): void
    {
        $payload = new Payload(
            command: Command::ServerStart,
            parameters: ['sid' => $id],
        );

        $this->transporter->request($payload);
    }

    /**
     * Stops the virtual server specified by its ID.
     */
    public function stop(int $id, ?string $reasonMessage = null): void
    {
        $payload = new Payload(
            command: Command::ServerStop,
            parameters: ['sid' => $id, 'reasonmsg' => $reasonMessage],
        );

        $this->transporter->request($payload);
    }

    /**
     * Stops the entire TeamSpeak server process.
     */
    public function stopProcess(?string $reasonMessage = null): void
    {
        $payload = new Payload(
            command: Command::ServerProcessStop,
            parameters: ['reasonmsg' => $reasonMessage],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays detailed configuration information about the selected virtual server.
     */
    public function info(): InfoResponse
    {
        $payload = new Payload(Command::ServerInfo);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{virtualserver_antiflood_points_needed_command_block: string, virtualserver_antiflood_points_needed_ip_block: string, virtualserver_antiflood_points_needed_plugin_block: string, virtualserver_antiflood_points_tick_reduce: string, virtualserver_channel_temp_delete_delay_default: string, virtualserver_client_connections: string, virtualserver_clientsonline: string, virtualserver_codec_encryption_mode: string, virtualserver_complain_autoban_count: string, virtualserver_complain_autoban_time: string, virtualserver_complain_remove_time: string, virtualserver_created: string, virtualserver_default_channel_admin_group: string, virtualserver_default_channel_group: string, virtualserver_default_server_group: string, virtualserver_filebase: string, virtualserver_flag_password: string, virtualserver_hostbanner_gfx_interval: string, virtualserver_hostbanner_gfx_url: string, virtualserver_hostbanner_mode: string, virtualserver_hostbanner_url: string, virtualserver_hostbutton_gfx_url: string, virtualserver_hostbutton_tooltip: string, virtualserver_hostbutton_url: string, virtualserver_hostmessage: string, virtualserver_hostmessage_mode: string, virtualserver_icon_id: string, virtualserver_id: string, virtualserver_log_channel: string, virtualserver_log_client: string, virtualserver_log_filetransfer: string, virtualserver_log_permissions: string, virtualserver_log_query: string, virtualserver_log_server: string, virtualserver_max_download_total_bandwidth: string, virtualserver_max_upload_total_bandwidth: string, virtualserver_maxclients: string, virtualserver_min_android_version: string, virtualserver_min_client_version: string, virtualserver_min_ios_version: string, virtualserver_name: string, virtualserver_name_phonetic: string, virtualserver_needed_identity_security_level: string, virtualserver_nickname: string, virtualserver_password: string, virtualserver_platform: string, virtualserver_port: string, virtualserver_priority_speaker_dimm_modificator: string, virtualserver_query_client_connections: string, virtualserver_queryclientsonline: string, virtualserver_reserved_slots: string, virtualserver_status: string, virtualserver_unique_identifier: string, virtualserver_uptime: string, virtualserver_version: string, virtualserver_weblist_enabled: string, virtualserver_welcomemessage: string}}> $response */
        $response = $this->transporter->request($payload);

        return InfoResponse::from($response->body());
    }

    /**
     * Displays the connection statistics for the selected virtual server.
     */
    public function connectionInfo(): ConnectionInfoResponse
    {
        $payload = new Payload(Command::ServerRequestConnectionInfo);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{connection_filetransfer_bandwidth_sent: string, connection_filetransfer_bandwidth_received: string, connection_filetransfer_bytes_sent_total: string, connection_filetransfer_bytes_received_total: string, connection_packets_sent_total: string, connection_bytes_sent_total: string, connection_packets_received_total: string, connection_bytes_received_total: string, connection_bandwidth_sent_last_second_total: string, connection_bandwidth_sent_last_minute_total: string, connection_bandwidth_received_last_second_total: string, connection_bandwidth_received_last_minute_total: string}}> $response */
        $response = $this->transporter->request($payload);

        return ConnectionInfoResponse::from($response->body());
    }

    /**
     * Creates a new temporary server password.
     *
     * The password is valid for the specified duration in seconds.
     * Optionally specify a target channel and its password.
     */
    public function addTempPassword(string $password, string $description, int $duration, int $channelId = 0, string $channelPassword = ''): void
    {
        $payload = new Payload(
            command: Command::ServerTempPasswordAdd,
            parameters: [
                'pw' => $password,
                'desc' => $description,
                'theduration' => $duration,
                'tcid' => $channelId,
                'tcpw' => $channelPassword,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Deletes the temporary server password specified by its value.
     */
    public function deleteTempPassword(string $password): void
    {
        $payload = new Payload(
            command: Command::ServerTempPasswordDel,
            parameters: ['pw' => $password],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of active temporary server passwords.
     */
    public function listTempPasswords(): TempPasswordListResponse
    {
        $payload = new Payload(Command::ServerTempPasswordList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{nickname: string, uid: string, desc: string, pw_clear: string, start: string, end: string, tcid: string}>> $response */
        $response = $this->transporter->request($payload);

        return TempPasswordListResponse::from($response->body());
    }

    /**
     * Changes the selected virtual server's configuration using given properties.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function edit(array $properties): void
    {
        $payload = new Payload(
            command: Command::ServerEdit,
            parameters: $properties,
        );

        $this->transporter->request($payload);
    }

    /**
     * Creates a snapshot of the selected virtual server.
     *
     * Returns the snapshot hash and data which can be used with deploySnapshot.
     */
    public function createSnapshot(): CreateSnapshotResponse
    {
        $payload = new Payload(Command::ServerSnapshotCreate);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{hash: string, virtualserver_snapshot: string}}> $response */
        $response = $this->transporter->request($payload);

        return CreateSnapshotResponse::from($response->body());
    }

    /**
     * Deploys a previously created virtual server snapshot.
     */
    public function deploySnapshot(string $snapshot): void
    {
        $payload = new Payload(
            command: Command::ServerSnapshotDeploy,
            parameters: ['virtualserver_snapshot' => $snapshot],
        );

        $this->transporter->request($payload);
    }
}
