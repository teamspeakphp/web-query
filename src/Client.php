<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery;

use TeamSpeak\WebQuery\Contracts\ClientContract;
use TeamSpeak\WebQuery\Contracts\TransporterContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Resources\Bans;
use TeamSpeak\WebQuery\Resources\ChannelGroups;
use TeamSpeak\WebQuery\Resources\ChannelPermissions;
use TeamSpeak\WebQuery\Resources\Channels;
use TeamSpeak\WebQuery\Resources\Clients;
use TeamSpeak\WebQuery\Resources\Complaints;
use TeamSpeak\WebQuery\Resources\CustomProperties;
use TeamSpeak\WebQuery\Resources\DatabaseClients;
use TeamSpeak\WebQuery\Resources\Logs;
use TeamSpeak\WebQuery\Resources\Messages;
use TeamSpeak\WebQuery\Resources\Permissions;
use TeamSpeak\WebQuery\Resources\PrivilegeKeys;
use TeamSpeak\WebQuery\Resources\ServerGroups;
use TeamSpeak\WebQuery\Resources\Servers;
use TeamSpeak\WebQuery\Resources\Tokens;
use TeamSpeak\WebQuery\Responses\WhoAmI\WhoAmIResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final readonly class Client implements ClientContract
{
    public function __construct(private TransporterContract $transporter) {}

    /**
     * Interact with the bans.
     */
    public function bans(): Bans
    {
        return new Bans($this->transporter);
    }

    /**
     * Interact with the channel groups.
     */
    public function channelGroups(): ChannelGroups
    {
        return new ChannelGroups($this->transporter);
    }

    /**
     * Interact with the channel permissions.
     */
    public function channelPermissions(): ChannelPermissions
    {
        return new ChannelPermissions($this->transporter);
    }

    /**
     * Interact with the channels.
     */
    public function channels(): Channels
    {
        return new Channels($this->transporter);
    }

    /**
     * Interact with the clients.
     */
    public function clients(): Clients
    {
        return new Clients($this->transporter);
    }

    /**
     * Interact with the complaints.
     */
    public function complaints(): Complaints
    {
        return new Complaints($this->transporter);
    }

    /**
     * Interact with the custom properties.
     */
    public function customProperties(): CustomProperties
    {
        return new CustomProperties($this->transporter);
    }

    /**
     * Interact with the database of clients.
     */
    public function databaseClients(): DatabaseClients
    {
        return new DatabaseClients($this->transporter);
    }

    /**
     * Interact with the logs.
     */
    public function logs(): Logs
    {
        return new Logs($this->transporter);
    }

    /**
     * Interact with the messages.
     */
    public function messages(): Messages
    {
        return new Messages($this->transporter);
    }

    /**
     * Interact with the permissions.
     */
    public function permissions(): Permissions
    {
        return new Permissions($this->transporter);
    }

    /**
     * Interact with the privilege keys.
     */
    public function privilegeKeys(): PrivilegeKeys
    {
        return new PrivilegeKeys($this->transporter);
    }

    /**
     * Interact with the server groups.
     */
    public function serversGroups(): ServerGroups
    {
        return new ServerGroups($this->transporter);
    }

    /**
     * Interact with the servers.
     */
    public function servers(): Servers
    {
        return new Servers($this->transporter);
    }

    /**
     * Interact with the tokens.
     */
    public function tokens(): Tokens
    {
        return new Tokens($this->transporter);
    }

    /**
     * Returns information about the current query client session.
     */
    public function whoami(): WhoAmIResponse
    {
        $payload = new Payload(Command::WhoAmI);

        /** @var ValueObjects\Transporter\Response<array{0: array{client_channel_id: string, client_database_id: string, client_id: string, client_login_name: string, client_nickname: string, client_origin_server_id: string, client_unique_identifier: string, virtualserver_id: string, virtualserver_port: string, virtualserver_status: string, virtualserver_unique_identifier: string}}> $response */
        $response = $this->transporter->request($payload);

        return WhoAmIResponse::from($response->body());
    }
}
