<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\ListResponse;
use TeamSpeak\WebQuery\Responses\Clients\ListResponseClient;

test('from', function () {
    $response = ListResponse::from([[
        'cid' => '1',
        'clid' => '841',
        'client_database_id' => '10',
        'client_nickname' => 'Smith',
        'client_type' => '0',
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(ListResponseClient::class);
});
