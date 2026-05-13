<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponse;
use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponsePermission;

test('from', function () {
    $response = ListForClientResponse::from([[
        'cid' => '1',
        'cldbid' => '18',
        'permid' => '42',
        'permnegated' => '0',
        'permskip' => '0',
        'permvalue' => '75',
    ]]);

    expect($response->permissions)->toBeArray()->toHaveCount(1)
        ->and($response->permissions[0])->toBeInstanceOf(ListForClientResponsePermission::class);
});
