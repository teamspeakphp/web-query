<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\ListResponse;
use TeamSpeak\WebQuery\Responses\Permissions\ListResponsePermission;

test('from', function () {
    $response = ListResponse::from([[
        'permid' => '1',
        'permname' => 'b_serverinstance_help_view',
        'permdesc' => 'Retrieve information about the server instance',
    ]]);

    expect($response->permissions)->toHaveCount(1)
        ->and($response->permissions[0])->toBeInstanceOf(ListResponsePermission::class);
});
