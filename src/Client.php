<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery;

use TeamSpeak\WebQuery\Contracts\ClientContract;
use TeamSpeak\WebQuery\Contracts\TransporterContract;
use TeamSpeak\WebQuery\Resources\Bans;
use TeamSpeak\WebQuery\Resources\ChannelGroups;
use TeamSpeak\WebQuery\Resources\ChannelPermissions;
use TeamSpeak\WebQuery\Resources\Channels;
use TeamSpeak\WebQuery\Resources\Clients;
use TeamSpeak\WebQuery\Resources\Complains;
use TeamSpeak\WebQuery\Resources\CustomProperties;
use TeamSpeak\WebQuery\Resources\DatabaseClients;
use TeamSpeak\WebQuery\Resources\Logs;
use TeamSpeak\WebQuery\Resources\Messages;
use TeamSpeak\WebQuery\Resources\Permissions;
use TeamSpeak\WebQuery\Resources\PrivilegeKeys;
use TeamSpeak\WebQuery\Resources\ServerGroups;
use TeamSpeak\WebQuery\Resources\Servers;
use TeamSpeak\WebQuery\Resources\Tokens;

final readonly class Client implements ClientContract
{
    public function __construct(private TransporterContract $transporter) {}

    public function bans(): Bans
    {
        return new Bans($this->transporter);
    }

    public function channelGroups(): ChannelGroups
    {
        return new ChannelGroups($this->transporter);
    }

    public function channelPermissions(): ChannelPermissions
    {
        return new ChannelPermissions($this->transporter);
    }

    public function channels(): Channels
    {
        return new Channels($this->transporter);
    }

    public function clients(): Clients
    {
        return new Clients($this->transporter);
    }

    public function complains(): Complains
    {
        return new Complains($this->transporter);
    }

    public function customProperties(): CustomProperties
    {
        return new CustomProperties($this->transporter);
    }

    public function databaseClients(): DatabaseClients
    {
        return new DatabaseClients($this->transporter);
    }

    public function logs(): Logs
    {
        return new Logs($this->transporter);
    }

    public function messages(): Messages
    {
        return new Messages($this->transporter);
    }

    public function permissions(): Permissions
    {
        return new Permissions($this->transporter);
    }

    public function privilegeKeys(): PrivilegeKeys
    {
        return new PrivilegeKeys($this->transporter);
    }

    public function serversGroups(): ServerGroups
    {
        return new ServerGroups($this->transporter);
    }

    public function servers(): Servers
    {
        return new Servers($this->transporter);
    }

    public function tokens(): Tokens
    {
        return new Tokens($this->transporter);
    }
}
