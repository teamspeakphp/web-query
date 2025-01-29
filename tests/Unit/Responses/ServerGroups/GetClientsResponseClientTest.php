<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponseClient;

test('from', function () {
    $response = GetClientsResponseClient::from([
        'cldbid' => '18',
    ]);

    expect($response)
        ->toBeInstanceOf(GetClientsResponseClient::class)
        ->databaseId->toBe(18);
});
