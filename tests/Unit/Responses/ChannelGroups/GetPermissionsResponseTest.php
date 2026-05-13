<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\GetPermissionsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetPermissionsResponsePermission;

test('from', function () {
    $response = GetPermissionsResponse::from([[
        'cgid' => '5',
        'permid' => '42',
        'permnegated' => '0',
        'permskip' => '0',
        'permvalue' => '75',
    ]]);

    expect($response->permissions)->toBeArray()->toHaveCount(1)
        ->and($response->permissions[0])->toBeInstanceOf(GetPermissionsResponsePermission::class);
});
