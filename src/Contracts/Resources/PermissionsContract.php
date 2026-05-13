<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Permissions\FindResponse;
use TeamSpeak\WebQuery\Responses\Permissions\GetIdByNameResponse;
use TeamSpeak\WebQuery\Responses\Permissions\GetResponse;
use TeamSpeak\WebQuery\Responses\Permissions\ListResponse;
use TeamSpeak\WebQuery\Responses\Permissions\OverviewResponse;
use TeamSpeak\WebQuery\Responses\Permissions\ResetResponse;

interface PermissionsContract
{
    /**
     * Displays a list of all permissions available on the server.
     */
    public function list(): ListResponse;

    /**
     * Returns the ID of a permission specified by name.
     */
    public function getIdByName(string $name): GetIdByNameResponse;

    /**
     * Displays all permissions for a client in a specific channel.
     */
    public function overview(int $channelId, int $clientDatabaseId): OverviewResponse;

    /**
     * Displays the current value of a permission for the selected virtual server.
     *
     * A permission can be specified by ID or name.
     */
    public function get(string|int $id): GetResponse;

    /**
     * Displays all clients and groups assigned a specific permission.
     *
     * A permission can be specified by ID or name.
     */
    public function find(string|int $id): FindResponse;

    /**
     * Resets the permission settings of the virtual server to default values.
     *
     * Returns a new administrator privilege key.
     */
    public function reset(): ResetResponse;
}
