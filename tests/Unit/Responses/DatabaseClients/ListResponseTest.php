<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\DatabaseClients\ListResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\ListResponseClient;

test('from', function () {
    $response = ListResponse::from([[
        'cldbid' => '2',
        'client_created' => '123456789',
        'client_description' => '',
        'client_lastconnected' => '123456789',
        'client_lastip' => '',
        'client_login_name' => '',
        'client_nickname' => 'foo',
        'client_totalconnections' => '0',
        'client_unique_identifier' => 'bar',
        'count' => '1',
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(ListResponseClient::class)
        ->count->toBe(1);
});
