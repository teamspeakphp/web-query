<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts;

use TeamSpeak\WebQuery\Contracts\Resources\BansContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelGroupsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelPermissionsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ChannelsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ClientsContract;
use TeamSpeak\WebQuery\Contracts\Resources\ComplaintsContract;
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
    /**
     * Interact with the bans.
     */
    public function bans(): BansContract;

    /**
     * Interact with the channel groups.
     */
    public function channelGroups(): ChannelGroupsContract;

    /**
     * Interact with the channel permissions.
     */
    public function channelPermissions(): ChannelPermissionsContract;

    /**
     * Interact with the channels.
     */
    public function channels(): ChannelsContract;

    /**
     * Interact with the clients.
     */
    public function clients(): ClientsContract;

    /**
     * Interact with the complaints.
     */
    public function complaints(): ComplaintsContract;

    /**
     * Interact with the custom properties.
     */
    public function customProperties(): CustomPropertiesContract;

    /**
     * Interact with the database of clients.
     */
    public function databaseClients(): DatabaseClientsContract;

    /**
     * Interact with the logs.
     */
    public function logs(): LogsContract;

    /**
     * Interact with the messages.
     */
    public function messages(): MessagesContract;

    /**
     * Interact with the permissions.
     */
    public function permissions(): PermissionsContract;

    /**
     * Interact with the privilege keys.
     */
    public function privilegeKeys(): PrivilegeKeysContract;

    /**
     * Interact with the server groups.
     */
    public function serversGroups(): ServerGroupsContract;

    /**
     * Interact with the servers.
     */
    public function servers(): ServersContract;

    /**
     * Interact with the tokens.
     */
    public function tokens(): TokensContract;
}
