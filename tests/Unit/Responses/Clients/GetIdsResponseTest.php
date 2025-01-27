<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetIdsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetIdsResponseClient;

test('from', function () {
    $response = GetIdsResponse::from([[
        'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
        'clid' => '1',
        'name' => 'Janko',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetIdsResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(GetIdsResponseClient::class);
});
