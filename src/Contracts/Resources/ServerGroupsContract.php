<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Responses\ServerGroups\AddResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\CopyResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetByClientResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\ListResponse;

interface ServerGroupsContract
{
    /**
     * Displays a list of server groups available.
     *
     * Depending on your permissions, the output may also contain
     * global ServerQuery groups and template groups.
     */
    public function list(): ListResponse;

    /**
     * Creates a new server group using the name specified with name and displays its ID.
     *
     * The optional type parameter can be used to create ServerQuery groups and template groups.
     */
    public function add(string $name, ?PermissionGroupDatabaseTypes $type = null): AddResponse;

    /**
     * Creates a new template server group using the name specified with name and displays its ID.
     */
    public function addTemplate(string $name): AddResponse;

    /**
     * Creates a new regular server group using the name specified with name and displays its ID.
     */
    public function addRegular(string $name): AddResponse;

    /**
     * Creates a new query server group using the name specified with name and displays its ID.
     */
    public function addQuery(string $name): AddResponse;

    /**
     * Deletes the server group.
     *
     * If force is **true**, the server group will be deleted even if there are clients within.
     */
    public function delete(int $id, bool $force = false): void;

    /**
     * Creates a copy of the server group.
     *
     * If target is **null**, the server will create a new group.
     * To overwrite an existing group, simply set target to the ID of a designated target group.
     * If a target group is set, the name parameter will be ignored.
     * The type parameter can be used to create ServerQuery groups and template groups.
     */
    public function copy(int $id, ?int $target = null, ?string $name = null, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse;

    /**
     * Creates a copy of the server group with overwriting an existing group.
     */
    public function clone(int $id, string $name, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse;

    /**
     * Creates a copy of the server group with overwriting an existing group.
     */
    public function overwrite(int $from, int $to, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse;

    /**
     * Changes the name of the server group.
     */
    public function rename(int $id, string $name): void;

    /**
     * Displays a list of permissions assigned to the server group.
     *
     * If the names option is **true**, the output will contain the permission names instead of the internal IDs.
     */
    public function getPermissions(int $id, bool $names = false): GetPermissionsResponse;

    /**
     * Adds a permission to the server group.
     */
    public function addPermission(int $serverGroupId, string|int $id, int $value, bool $skip = false): void;

    /**
     * Removes a permission from the server group.
     */
    public function deletePermission(int $serverGroupId, string|int $id): void;

    /**
     * Adds a client to the server group.
     *
     * Please note that a client cannot be added to default groups or template groups.
     */
    public function addClient(int $id, int $clientDatabaseId): void;

    /**
     * Removes a client from the server group.
     */
    public function deleteClient(int $id, int $clientDatabaseId): void;

    /**
     * Displays the IDs of all clients currently residing in the server group.
     *
     * If you are using the optional names option, the output will also contain
     * the last known nickname and the unique identifier of the clients.
     */
    public function getClients(int $id, bool $names = false): GetClientsResponse;

    /**
     * Displays all server groups the client is currently residing in.
     */
    public function getByClient(int $clientDatabaseId): GetByClientResponse;
}
