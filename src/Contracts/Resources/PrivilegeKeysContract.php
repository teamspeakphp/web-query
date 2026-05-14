<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\PrivilegeKeys\AddResponse;
use TeamSpeak\WebQuery\Responses\PrivilegeKeys\ListResponse;

interface PrivilegeKeysContract
{
    /**
     * Displays a list of privilege keys available on the virtual server.
     */
    public function list(): ListResponse;

    /**
     * Creates a new privilege key.
     *
     * Type 0 grants membership to a server group (id1 = server group ID).
     * Type 1 grants membership to a channel group in a specific channel (id1 = channel group ID, id2 = channel ID).
     */
    public function add(int $type, int $id1, int $id2 = 0, string $description = '', string $customSet = ''): AddResponse;

    /**
     * Deletes an existing privilege key.
     */
    public function delete(string $token): void;

    /**
     * Redeems a privilege key and gains the associated group memberships.
     */
    public function redeem(string $token): void;
}
