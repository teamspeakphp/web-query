<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponse;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListResponse;

interface ChannelPermissionsContract
{
    /**
     * Displays a list of permissions assigned to the channel.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function list(int $channelId, bool $names = false): ListResponse;

    /**
     * Adds a permission to the channel.
     */
    public function add(int $channelId, string|int $id, int $value, bool $negated = false, bool $skip = false): void;

    /**
     * Removes a permission from the channel.
     */
    public function delete(int $channelId, string|int $id): void;

    /**
     * Displays a list of permissions assigned to a client in the channel.
     *
     * If names is true, permission names are returned instead of IDs.
     */
    public function listForClient(int $channelId, int $clientDatabaseId, bool $names = false): ListForClientResponse;

    /**
     * Adds a permission to a client in the channel.
     */
    public function addForClient(int $channelId, int $clientDatabaseId, string|int $id, int $value, bool $negated = false, bool $skip = false): void;

    /**
     * Removes a permission from a client in the channel.
     */
    public function deleteForClient(int $channelId, int $clientDatabaseId, string|int $id): void;
}
