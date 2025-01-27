<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetDbIdFromUidResponse;

test('from', function () {
    $response = GetDbIdFromUidResponse::from([[
        'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
        'cldbid' => '1',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetDbIdFromUidResponse::class)
        ->databaseId->toBe(1)
        ->uniqueIdentifier->toBe('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});
