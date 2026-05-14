<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\CustomProperties\InfoResponse;
use TeamSpeak\WebQuery\Responses\CustomProperties\SearchResponse;

interface CustomPropertiesContract
{
    /**
     * Searches for clients with a custom property matching the given ident and pattern.
     */
    public function search(string $ident, string $pattern): SearchResponse;

    /**
     * Sets a custom property for the client with the given database ID.
     */
    public function set(int $clientDatabaseId, string $ident, string $value): void;

    /**
     * Displays all custom properties for the client with the given database ID.
     */
    public function info(int $clientDatabaseId): InfoResponse;
}
