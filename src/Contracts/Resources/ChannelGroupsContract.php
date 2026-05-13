<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Responses\ChannelGroups\AddResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\CopyResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\ListResponse;

interface ChannelGroupsContract
{
    /**
     * Displays a list of channel groups available.
     */
    public function list(): ListResponse;

    /**
     * Creates a new channel group using the given name and type.
     */
    public function add(string $name, ?PermissionGroupDatabaseTypes $type = null): AddResponse;

    /**
     * Deletes the channel group. If force is true, the group is deleted even if clients are assigned to it.
     */
    public function delete(int $id, bool $force = false): void;

    /**
     * Creates a copy of the channel group.
     *
     * If target is null a new group is created; otherwise the target group is overwritten.
     */
    public function copy(int $id, ?int $target = null, ?string $name = null, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse;

    /**
     * Changes the name of the channel group.
     */
    public function rename(int $id, string $name): void;

    /**
     * Displays a list of permissions assigned to the channel group.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function getPermissions(int $id, bool $names = false): GetPermissionsResponse;

    /**
     * Adds a permission to the channel group.
     */
    public function addPermission(int $channelGroupId, string|int $id, int $value, bool $skip = false): void;

    /**
     * Removes a permission from the channel group.
     */
    public function deletePermission(int $channelGroupId, string|int $id): void;

    /**
     * Displays all client/channel assignments for the given channel group.
     *
     * Optionally filter by channel or client database ID.
     */
    public function getClients(int $id, ?int $channelId = null, ?int $clientDatabaseId = null): GetClientsResponse;

    /**
     * Sets the channel group of a client in the specified channel.
     */
    public function setClientChannelGroup(int $channelGroupId, int $channelId, int $clientDatabaseId): void;
}
