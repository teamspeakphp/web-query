<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\FindResponseClient;

test('from', function () {
    $response = FindResponseClient::from([
        'clid' => '841',
        'client_nickname' => 'Smith',
    ]);

    expect($response)
        ->toBeInstanceOf(FindResponseClient::class)
        ->id->toBe(841)
        ->nickname->toBe('Smith');
});
