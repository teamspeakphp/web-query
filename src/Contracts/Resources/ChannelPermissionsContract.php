<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponse;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListResponse;

interface ChannelPermissionsContract
{
    public function list(int $channelId, bool $names = false): ListResponse;

    public function add(int $channelId, string|int $id, int $value, bool $negated = false, bool $skip = false): void;

    public function delete(int $channelId, string|int $id): void;

    public function listForClient(int $channelId, int $clientDatabaseId, bool $names = false): ListForClientResponse;

    public function addForClient(int $channelId, int $clientDatabaseId, string|int $id, int $value, bool $negated = false, bool $skip = false): void;

    public function deleteForClient(int $channelId, int $clientDatabaseId, string|int $id): void;
}
