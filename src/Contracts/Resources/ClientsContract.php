<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Enums\ReasonIdentifier;
use TeamSpeak\WebQuery\Responses\Clients\FindResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetDbIdFromUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetIdsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetNameFromDbIdResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetNameFromUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetUidResponse;
use TeamSpeak\WebQuery\Responses\Clients\InfoResponse;
use TeamSpeak\WebQuery\Responses\Clients\ListResponse;
use TeamSpeak\WebQuery\Responses\Clients\SetServerQueryLoginResponse;

interface ClientsContract
{
    /**
     * Displays a list of clients online on a virtual server including their ID, nickname, status flags, etc.
     *
     * The output can be modified using several command options.
     * Please note that the output will only contain clients, which are currently
     * in channels you can subscribe to.
     */
    public function list(bool $uid = false, bool $away = false, bool $voice = false, bool $times = false, bool $groups = false, bool $info = false, bool $country = false, bool $ip = false, bool $badges = false): ListResponse;

    /**
     * Displays detailed configuration information about a client including unique ID, nickname, client version, etc.
     */
    public function info(int $id): InfoResponse;

    /**
     * Displays a list of clients matching a given name pattern.
     */
    public function find(string $pattern): FindResponse;

    /**
     * Changes a clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
     * @param  array<string, string>  $properties
     */
    public function edit(int $id, array $properties): void;

    /**
     * Changes a clients description.
     */
    public function editDescription(int $id, string $description): void;

    /**
     * Displays all client IDs matching the unique identifier specified by unique identifier.
     */
    public function getIds(string $uid): GetIdsResponse;

    /**
     * Displays the database ID matching the unique identifier.
     */
    public function getDbIdFromUid(string $uid): GetDbIdFromUidResponse;

    /**
     * Displays the database ID and nickname matching the unique identifier.
     */
    public function getNameFromUid(string $uid): GetNameFromUidResponse;

    /**
     * Displays the unique identifier matching the client ID.
     */
    public function getUid(int $id): GetUidResponse;

    /**
     * Displays the unique identifier and nickname matching the database ID.
     */
    public function getNameFromDbId(int $dbId): GetNameFromDbIdResponse;

    /**
     * Updates your own ServerQuery login credentials using a specified username.
     *
     * The password will be auto-generated.
     */
    public function setServerQueryLogin(string $loginName): SetServerQueryLoginResponse;

    /**
     * Change your ServerQuery clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
     * @param  array<string, string>  $properties
     */
    public function update(array $properties): void;

    /**
     * Change your ServerQuery clients nickname.
     */
    public function updateNickname(string $nickname): void;

    /**
     * Moves one or more clients to the channel with ID.
     *
     * If the target channel has a password, it needs to be specified with cpw.
     * If the channel has no password, the parameter can be omitted.
     *
     * @param  list<int>|int  $id
     */
    public function move(array|int $id, int $channelId, ?string $password = null): void;

    /**
     * Kicks one or more clients from their currently joined channel or from the server.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kick(array|int $id, ReasonIdentifier $type, ?string $reason = null): void;

    /**
     * Kicks one or more clients from their currently joined channel.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kickFromChannel(array|int $id, ?string $reason = null): void;

    /**
     * Kicks one or more clients from the server.
     *
     * The reason parameter specifies a text message sent to the kicked clients.
     * This parameter is optional and may only have a maximum of 40 characters.
     *
     * @param  list<int>|int  $id
     */
    public function kickFromServer(array|int $id, ?string $reason = null): void;

    /**
     * Sends a poke message to the client.
     */
    public function poke(int $id, string $message): void;

    /**
     * Displays a list of permissions defined for a client.
     */
    public function getPermissions(int $databaseId, bool $name = false): GetPermissionsResponse;

    /**
     * Adds a set of specified permission to a client.
     *
     * A permission can be specified by ID or name.
     */
    public function addPermission(int $databaseId, string|int $id, int $value, bool $skip = false): void;

    /**
     * Removes a set of specified permission from a client.
     *
     * A permission can be specified by ID or name.
     */
    public function deletePermission(int $databaseId, string|int $id): void;
}
