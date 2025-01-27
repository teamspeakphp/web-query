<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\Clients\GetPermissionsResponsePermission;

test('from', function () {
    $response = GetPermissionsResponse::from([[
        'cldbid' => '10',
        'permid' => '176',
        'permnegated' => '0',
        'permskip' => '1',
        'permvalue' => '75',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetPermissionsResponse::class)
        ->clients->toBeArray()->toHaveCount(1)
        ->clients->each->toBeInstanceOf(GetPermissionsResponsePermission::class);
});
