<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetPermissionsResponsePermission;

test('from', function () {
    $response = GetPermissionsResponse::from([[
        'sgid' => '10',
        'permid' => '176',
        'permnegated' => '0',
        'permskip' => '1',
        'permvalue' => '75',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetPermissionsResponse::class)
        ->permissions->toBeArray()->toHaveCount(1)
        ->permissions->each->toBeInstanceOf(GetPermissionsResponsePermission::class);
});
