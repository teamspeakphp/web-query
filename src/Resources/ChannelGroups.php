<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ChannelGroupsContract;
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\ChannelGroups\AddResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\CopyResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class ChannelGroups implements ChannelGroupsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of channel groups available.
     */
    public function list(): ListResponse
    {
        $payload = new Payload(Command::ChannelGroupList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{iconid: string, n_member_addp: string, n_member_removep: string, n_modifyp: string, name: string, namemode: string, savedb: string, cgid: string, sortid: string, type: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Creates a new channel group using the given name and type.
     */
    public function add(string $name, ?PermissionGroupDatabaseTypes $type = null): AddResponse
    {
        $payload = new Payload(
            command: Command::ChannelGroupAdd,
            parameters: ['name' => $name, 'type' => $type?->value],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cgid: string}}> $response */
        $response = $this->transporter->request($payload);

        return AddResponse::from($response->body());
    }

    /**
     * Deletes the channel group. If force is true, the group is deleted even if clients are assigned to it.
     */
    public function delete(int $id, bool $force = false): void
    {
        $payload = new Payload(
            command: Command::ChannelGroupDel,
            parameters: ['cgid' => $id, 'force' => $force],
        );

        $this->transporter->request($payload);
    }

    /**
     * Creates a copy of the channel group.
     *
     * If target is null a new group is created; otherwise the target group is overwritten.
     */
    public function copy(int $id, ?int $target = null, ?string $name = null, PermissionGroupDatabaseTypes $type = PermissionGroupDatabaseTypes::Regular): CopyResponse
    {
        $payload = new Payload(
            command: Command::ChannelGroupCopy,
            parameters: ['scgid' => $id, 'tcgid' => $target ?? 0, 'name' => $name ?? ' ', 'type' => $type->value],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0?: array{cgid: string}}> $response */
        $response = $this->transporter->request($payload);

        return CopyResponse::from($response->body());
    }

    /**
     * Changes the name of the channel group.
     */
    public function rename(int $id, string $name): void
    {
        $payload = new Payload(
            command: Command::ChannelGroupRename,
            parameters: ['cgid' => $id, 'name' => $name],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of permissions assigned to the channel group.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function getPermissions(int $id, bool $names = false): GetPermissionsResponse
    {
        $payload = new Payload(
            command: Command::ChannelGroupPermList,
            parameters: ['cgid' => $id],
            options: ['permsid' => $names],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cgid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetPermissionsResponse::from($response->body());
    }

    /**
     * Adds a permission to the channel group.
     */
    public function addPermission(int $channelGroupId, string|int $id, int $value, bool $skip = false): void
    {
        $payload = new Payload(
            command: Command::ChannelGroupAddPerm,
            parameters: [
                'cgid' => $channelGroupId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
                'permvalue' => $value,
                'permskip' => $skip,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a permission from the channel group.
     */
    public function deletePermission(int $channelGroupId, string|int $id): void
    {
        $payload = new Payload(
            command: Command::ChannelGroupDelPerm,
            parameters: [
                'cgid' => $channelGroupId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays all client/channel assignments for the given channel group.
     *
     * Optionally filter by channel or client database ID.
     */
    public function getClients(int $id, ?int $channelId = null, ?int $clientDatabaseId = null): GetClientsResponse
    {
        $payload = new Payload(
            command: Command::ChannelGroupClientList,
            parameters: ['cgid' => $id, 'cid' => $channelId, 'cldbid' => $clientDatabaseId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cid: string, cldbid: string, cgid: string}>> $response */
        $response = $this->transporter->request($payload);

        return GetClientsResponse::from($response->body());
    }

    /**
     * Sets the channel group of a client in the specified channel.
     */
    public function setClientChannelGroup(int $channelGroupId, int $channelId, int $clientDatabaseId): void
    {
        $payload = new Payload(
            command: Command::SetClientChannelGroup,
            parameters: ['cgid' => $channelGroupId, 'cid' => $channelId, 'cldbid' => $clientDatabaseId],
        );

        $this->transporter->request($payload);
    }
}
