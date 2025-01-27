<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetUidResponse;

test('from', function () {
    $response = GetUidResponse::from([[
        'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
        'clid' => '1',
        'nickname' => 'Smith',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetUidResponse::class)
        ->id->toBe(1)
        ->name->toBe('Smith')
        ->uniqueIdentifier->toBe('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});
