<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ServerGroupsContract;
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\ServerGroups\AddResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\CopyResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetByClientResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class ServerGroups implements ServerGroupsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of server groups available.
     *
     * Depending on your permissions, the output may also contain
     * global ServerQuery groups and template groups.
     */
    public function list(): ListResponse
    {
        $payload = new Payload(Command::ServerGroupList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{iconid: string, n_member_addp: string, n_member_removep: string, n_modifyp: string, name: string, namemode: string, savedb: string, sgid: string, sortid: string, type: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Creates a new server group using the name specified with name and displays its ID.
     *
     * The optional type parameter can be used to create ServerQuery groups and template groups.
     */
    public function add(string $name, ?PermissionGroupDatabaseTypes $type = null): AddResponse
    {
        $payload = new Payload(
            command: Command::ServerGroupAdd,
            parameters: ['name' => $name, 'type' => $type?->value],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{sgid: string}}> $response */
        $response = $this->transporter->request($payload);

        return AddResponse::from($response->body());
    }

    /**
     * Creates a new template server group using the name specified with name and displays its ID.
     */
    public function addTemplate(string $name): AddResponse
    {
        return $this->add($name, PermissionGroupDatabaseTypes::Template);
    }

    /**
     * Creates a new regular server group using the name specified with name and displays its ID.
     */
    public function addRegular(string $name): AddResponse
    {
        return $this->add($name, PermissionGroupDatabaseTypes::Regular);
    }

    /**
     * Creates a new query server group using the name specified with name and displays its ID.
     */
    public function addQuery(string $name): AddResponse
    {
        return $this->add($name, PermissionGroupDatabaseTypes::Query);
    }

    /**
     * Deletes the server group.
     *
     * If force is **true**, the server group will be deleted even if there are clients within.
     */
    public function delete(int $id, bool $force = false): void
    {
        $payload = new Payload(
            command: Command::ServerGroupDel,
            parameters: ['sgid' => $id, 'force' => $force],
        );

        $this->transporter->request($payload);
    }

    /**
     * Creates a copy of the server group.
     *
     * If target is **null**, the server will create a new group.
     * To overwrite an existing group, simply set target to the ID of a designated target group.
     * If a target group is set, the name parameter will be ignored.
     * The type parameter can be used to create ServerQuery groups and template groups.
     */
    public function copy(int $id, ?int $target = null, ?string $name = null, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse
    {
        $payload = new Payload(
            command: Command::ServerGroupCopy,
            // all parameters must be in a payload
            parameters: ['ssgid' => $id, 'tsgid' => $target ?? 0, 'name' => $name ?? ' ', 'type' => $type->value],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0?: array{sgid: string}}> $response */
        $response = $this->transporter->request($payload);

        return CopyResponse::from($response->body());
    }

    /**
     * Creates a copy of the server group with overwriting an existing group.
     */
    public function clone(int $id, string $name, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse
    {
        return $this->copy($id, null, $name, $type);
    }

    /**
     * Creates a copy of the server group with overwriting an existing group.
     */
    public function overwrite(int $from, int $to, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse
    {
        return $this->copy($from, $to, null, $type);
    }

    /**
     * Changes the name of the server group.
     */
    public function rename(int $id, string $name): void
    {
        $payload = new Payload(
            command: Command::ServerGroupRename,
            parameters: ['sgid' => $id, 'name' => $name],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of permissions assigned to the server group.
     *
     * If the names option is **true**, the output will contain the permission names instead of the internal IDs.
     */
    public function getPermissions(int $id, bool $names = false): GetPermissionsResponse
    {
        $payload = new Payload(
            command: Command::ServerGroupPermList,
            parameters: ['sgid' => $id],
            options: ['permsid' => $names],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{sgid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetPermissionsResponse::from($response->body());
    }

    /**
     * Adds a permission to the server group.
     */
    public function addPermission(int $serverGroupId, string|int $id, int $value, bool $skip = false): void
    {
        $payload = new Payload(
            command: Command::ServerGroupAddPerm,
            parameters: [
                'sgid' => $serverGroupId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
                'permvalue' => $value,
                'permskip' => $skip,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a permission from the server group.
     */
    public function deletePermission(int $serverGroupId, string|int $id): void
    {
        $payload = new Payload(
            command: Command::ClientDelPerm,
            parameters: [
                'sgid' => $serverGroupId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Adds a client to the server group.
     *
     * Please note that a client cannot be added to default groups or template groups.
     */
    public function addClient(int $id, int $clientDatabaseId): void
    {
        $payload = new Payload(
            command: Command::ServerGroupAddClient,
            parameters: ['sgid' => $id, 'cldbid' => $clientDatabaseId],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a client from the server group.
     */
    public function deleteClient(int $id, int $clientDatabaseId): void
    {
        $payload = new Payload(
            command: Command::ServerGroupDelClient,
            parameters: ['sgid' => $id, 'cldbid' => $clientDatabaseId],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays the IDs of all clients currently residing in the server group.
     *
     * If you are using the optional names option, the output will also contain
     * the last known nickname and the unique identifier of the clients.
     */
    public function getClients(int $id, bool $names = false): GetClientsResponse
    {
        $payload = new Payload(
            command: Command::ServerGroupClientList,
            parameters: ['sgid' => $id],
            options: ['names' => $names],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string, client_nickname?: string, client_unique_identifier?: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetClientsResponse::from($response->body());
    }

    /**
     * Displays all server groups the client is currently residing in.
     */
    public function getByClient(int $clientDatabaseId): GetByClientResponse
    {
        $payload = new Payload(
            command: Command::ServerGroupCopy,
            parameters: ['cldbid' => $clientDatabaseId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{name: string, sgid: string, cldbid: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetByClientResponse::from($response->body());
    }
}
