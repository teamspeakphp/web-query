<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\DatabaseClients\FindResponseClient;

test('from', function () {
    $response = FindResponseClient::from([
        'cldbid' => '1',
    ]);

    expect($response)
        ->toBeInstanceOf(FindResponseClient::class)
        ->databaseId->toBe(1);
});
