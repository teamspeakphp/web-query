<?php

declare(strict_types=1);

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

beforeEach(function () {
    $this->client = TeamSpeak::client('foo', 'bar', 1);
});

it('has bans', function () {
    expect($this->client->bans())->toBeInstanceOf(Bans::class);
});

it('has channel groups', function () {
    expect($this->client->channelGroups())->toBeInstanceOf(ChannelGroups::class);
});

it('has channel permissions', function () {
    expect($this->client->channelPermissions())->toBeInstanceOf(ChannelPermissions::class);
});

it('has channels', function () {
    expect($this->client->channels())->toBeInstanceOf(Channels::class);
});

it('has clients', function () {
    expect($this->client->clients())->toBeInstanceOf(Clients::class);
});

it('has complains', function () {
    expect($this->client->complains())->toBeInstanceOf(Complains::class);
});

it('has custom properties', function () {
    expect($this->client->customProperties())->toBeInstanceOf(CustomProperties::class);
});

it('has database clients', function () {
    expect($this->client->databaseClients())->toBeInstanceOf(DatabaseClients::class);
});

it('has logs', function () {
    expect($this->client->logs())->toBeInstanceOf(Logs::class);
});

it('has messages', function () {
    expect($this->client->messages())->toBeInstanceOf(Messages::class);
});

it('has permissions', function () {
    expect($this->client->permissions())->toBeInstanceOf(Permissions::class);
});

it('has privilege keys', function () {
    expect($this->client->privilegeKeys())->toBeInstanceOf(PrivilegeKeys::class);
});

it('has server groups', function () {
    expect($this->client->serversGroups())->toBeInstanceOf(ServerGroups::class);
});

it('has servers', function () {
    expect($this->client->servers())->toBeInstanceOf(Servers::class);
});

it('has tokens', function () {
    expect($this->client->tokens())->toBeInstanceOf(Tokens::class);
});
