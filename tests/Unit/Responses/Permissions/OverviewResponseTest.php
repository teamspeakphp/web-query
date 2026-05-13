<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\OverviewResponse;
use TeamSpeak\WebQuery\Responses\Permissions\OverviewResponsePermission;

test('from', function () {
    $response = OverviewResponse::from([[
        't' => '0',
        'id1' => '5',
        'id2' => '0',
        'p' => '17',
        'v' => '75',
        'n' => '0',
        's' => '1',
    ]]);

    expect($response->permissions)->toHaveCount(1)
        ->and($response->permissions[0])->toBeInstanceOf(OverviewResponsePermission::class);
});
