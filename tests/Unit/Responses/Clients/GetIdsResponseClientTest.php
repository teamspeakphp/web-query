<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetIdsResponseClient;

test('from', function () {
    $response = GetIdsResponseClient::from([
        'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
        'clid' => '1',
        'name' => 'Janko',
    ]);

    expect($response)
        ->toBeInstanceOf(GetIdsResponseClient::class)
        ->id->toBe(1)
        ->nickname->toBe('Janko')
        ->uniqueIdentifier->toBe('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});
