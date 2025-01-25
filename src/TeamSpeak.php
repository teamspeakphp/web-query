<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Client;
use TeamSpeak\WebQuery\Factory;

final class TeamSpeak
{
    public static function client(string $baseUri, string $apiKey, int $virtualServer): Client
    {
        return self::factory()
            ->withBaseUri($baseUri)
            ->withApiKey($apiKey)
            ->withVirtualServer($virtualServer)
            ->make();
    }

    public static function factory(): Factory
    {
        return new Factory;
    }
}
