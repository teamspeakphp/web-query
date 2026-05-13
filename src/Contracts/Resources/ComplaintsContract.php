<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Complaints\ListResponse;

interface ComplaintsContract
{
    /**
     * Displays a list of complaints on the selected virtual server.
     *
     * If targetClientDatabaseId is specified, only complaints about that client are shown.
     */
    public function list(?int $targetClientDatabaseId = null): ListResponse;

    /**
     * Submits a complaint about the client with the given database ID.
     */
    public function add(int $targetClientDatabaseId, string $message): void;

    /**
     * Deletes all complaints about the client with the given database ID.
     */
    public function deleteAll(int $targetClientDatabaseId): void;

    /**
     * Deletes the complaint about targetClientDatabaseId submitted by fromClientDatabaseId.
     */
    public function delete(int $targetClientDatabaseId, int $fromClientDatabaseId): void;
}
