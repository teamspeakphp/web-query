<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\DatabaseClients\FindResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\FindResponseClient;

test('from', function () {
    $response = FindResponse::from([[
        'cldbid' => '1',
    ]]);

    expect($response)
        ->toBeInstanceOf(FindResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(FindResponseClient::class);
});
