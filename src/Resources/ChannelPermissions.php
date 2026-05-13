<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ChannelPermissionsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponse;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class ChannelPermissions implements ChannelPermissionsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of permissions defined for a channel.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function list(int $channelId, bool $names = false): ListResponse
    {
        $payload = new Payload(
            command: Command::ChannelPermList,
            parameters: ['cid' => $channelId],
            options: ['permsid' => $names],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Adds a permission to a channel.
     *
     * A permission can be specified by ID or name.
     */
    public function add(int $channelId, string|int $id, int $value, bool $negated = false, bool $skip = false): void
    {
        $payload = new Payload(
            command: Command::ChannelAddPerm,
            parameters: [
                'cid' => $channelId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
                'permvalue' => $value,
                'permnegated' => $negated,
                'permskip' => $skip,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a permission from a channel.
     *
     * A permission can be specified by ID or name.
     */
    public function delete(int $channelId, string|int $id): void
    {
        $payload = new Payload(
            command: Command::ChannelDelPerm,
            parameters: [
                'cid' => $channelId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of permissions defined for a client in a specific channel.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function listForClient(int $channelId, int $clientDatabaseId, bool $names = false): ListForClientResponse
    {
        $payload = new Payload(
            command: Command::ChannelClientPermList,
            parameters: ['cid' => $channelId, 'cldbid' => $clientDatabaseId],
            options: ['permsid' => $names],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cid: string, cldbid: string, permid?: string, permsid?: string, permnegated: string, permskip: string, permvalue: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListForClientResponse::from($response->body());
    }

    /**
     * Adds a permission to a client in a specific channel.
     *
     * A permission can be specified by ID or name.
     */
    public function addForClient(int $channelId, int $clientDatabaseId, string|int $id, int $value, bool $negated = false, bool $skip = false): void
    {
        $payload = new Payload(
            command: Command::ChannelClientAddPerm,
            parameters: [
                'cid' => $channelId,
                'cldbid' => $clientDatabaseId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
                'permvalue' => $value,
                'permnegated' => $negated,
                'permskip' => $skip,
            ],
        );

        $this->transporter->request($payload);
    }

    /**
     * Removes a permission from a client in a specific channel.
     *
     * A permission can be specified by ID or name.
     */
    public function deleteForClient(int $channelId, int $clientDatabaseId, string|int $id): void
    {
        $payload = new Payload(
            command: Command::ChannelClientDelPerm,
            parameters: [
                'cid' => $channelId,
                'cldbid' => $clientDatabaseId,
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        $this->transporter->request($payload);
    }
}
