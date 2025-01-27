<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\FindResponse;
use TeamSpeak\WebQuery\Responses\Clients\FindResponseClient;

test('from', function () {
    $response = FindResponse::from([[
        'clid' => '841',
        'client_nickname' => 'Smith',
    ]]);

    expect($response)
        ->toBeInstanceOf(FindResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(FindResponseClient::class);
});
