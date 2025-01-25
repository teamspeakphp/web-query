<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts;

use TeamSpeak\WebQuery\Contracts\Resources\BansContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelGroupsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelPermissionsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ClientsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ComplainsContract;
use TeamSpeak\WebQuery\Contracts\Resources\CustomPropertiesContract;
use TeamSpeak\WebQuery\Contracts\Resources\DatabaseClientsContract;
use TeamSpeak\WebQuery\Contracts\Resources\LogsContract;
use TeamSpeak\WebQuery\Contracts\Resources\MessagesContract;
use TeamSpeak\WebQuery\Contracts\Resources\PermissionsContract;
use TeamSpeak\WebQuery\Contracts\Resources\PrivilegeKeysContract;
use TeamSpeak\WebQuery\Contracts\Resources\ServerGroupsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ServersContract;
use TeamSpeak\WebQuery\Contracts\Resources\TokensContract;

interface ClientContract
{
    public function bans(): BansContract;

    public function channelGroups(): ChannelGroupsContract;

    public function channelPermissions(): ChannelPermissionsContract;

    public function channels(): ChannelsContract;

    public function clients(): ClientsContract;

    public function complains(): ComplainsContract;

    public function customProperties(): CustomPropertiesContract;

    public function databaseClients(): DatabaseClientsContract;

    public function logs(): LogsContract;

    public function messages(): MessagesContract;

    public function permissions(): PermissionsContract;

    public function privilegeKeys(): PrivilegeKeysContract;

    public function serversGroups(): ServerGroupsContract;

    public function servers(): ServersContract;

    public function tokens(): TokensContract;
}
