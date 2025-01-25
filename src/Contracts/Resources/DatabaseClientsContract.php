<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\DatabaseClients\FindResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\InfoResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\ListResponse;

interface DatabaseClientsContract
{
    /**
     * Displays a list of client identities known by the server including their database ID, last nickname, etc.
     */
    public function list(?int $offset = null, ?int $limit = null, bool $count = false): ListResponse;

    /**
     * Displays detailed database information about a client including unique ID, creation date, etc.
     */
    public function info(int $databaseId): InfoResponse;

    /**
     * Displays a list of client database IDs matching a given pattern.
     *
     * You can either search for a clients last known nickname, or his unique
     * identity by using the **$uid** option. The pattern parameter can include
     * regular characters and SQL wildcard characters (e.g., %).
     */
    public function find(string $pattern, bool $uid = false): FindResponse;

    /**
     * Displays a list of client database IDs matching a given name pattern.
     *
     * The pattern parameter can include regular characters and SQL wildcard
     * characters (e.g., %).
     */
    public function findByName(string $pattern): FindResponse;

    /**
     * Displays a list of client database IDs matching a given unique ID pattern.
     *
     * The pattern parameter can include regular characters and SQL wildcard
     * characters (e.g., %).
     */
    public function findByUid(string $pattern): FindResponse;

    /**
     * Changes a clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
     * @param  array<string, string>  $properties
     */
    public function edit(int $databaseId, array $properties): void;

    /**
     * Changes a client description.
     */
    public function editDescription(int $databaseId, string $description): void;

    /**
     * Deletes a clients properties from the database.
     */
    public function delete(int $databaseId): void;
}
