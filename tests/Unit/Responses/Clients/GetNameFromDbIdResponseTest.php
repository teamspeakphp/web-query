<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetNameFromDbIdResponse;

test('from', function () {
    $response = GetNameFromDbIdResponse::from([[
        'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
        'cldbid' => '1',
        'name' => 'Smith',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetNameFromDbIdResponse::class)
        ->databaseId->toBe(1)
        ->name->toBe('Smith')
        ->uniqueIdentifier->toBe('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});
