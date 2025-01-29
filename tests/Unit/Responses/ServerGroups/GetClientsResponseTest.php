<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponseClient;

test('from', function () {
    $response = GetClientsResponse::from([[
        'cldbid' => '18',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetClientsResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(GetClientsResponseClient::class);
});
