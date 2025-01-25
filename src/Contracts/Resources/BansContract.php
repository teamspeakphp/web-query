<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Bans\CreateResponse;
use TeamSpeak\WebQuery\Responses\Bans\ListResponse;

interface BansContract
{
    /**
     * Bans the client specified with ID from the server.
     *
     * Please note that this will create two separate ban rules for the targeted clients IP address and his unique identifier.
     */
    public function client(int $id, ?int $seconds = 0, ?string $reason = null): CreateResponse;

    /**
     * Displays a list of active bans on the selected virtual server.
     */
    public function list(): ListResponse;

    /**
     * Adds a new ban rule on the selected virtual server.
     *
     * All parameters are optional but at least one of the following must be set:
     * **ipAddressRegexp**, **nameRegexp**, or **uniqueIdentifier**.
     */
    public function add(?string $ipAddressRegexp = null, ?string $nameRegexp = null, ?string $uniqueIdentifier = null, ?int $seconds = null, ?string $reason = null): CreateResponse;

    /**
     * Deletes the ban rule with ID from the server.
     */
    public function delete(int $id): void;

    /**
     * Deletes all active ban rules from the server.
     */
    public function deleteAll(): void;
}
