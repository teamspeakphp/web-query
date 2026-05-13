<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListResponse;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListResponsePermission;

test('from', function () {
    $response = ListResponse::from([[
        'cid' => '1',
        'permid' => '42',
        'permnegated' => '0',
        'permskip' => '0',
        'permvalue' => '75',
    ]]);

    expect($response->permissions)->toBeArray()->toHaveCount(1)
        ->and($response->permissions[0])->toBeInstanceOf(ListResponsePermission::class);
});
