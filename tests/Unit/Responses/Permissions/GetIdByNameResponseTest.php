<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\GetIdByNameResponse;

test('from', function () {
    $response = GetIdByNameResponse::from([[
        'permid' => '17835',
        'permsid' => 'b_serverinstance_help_view',
    ]]);

    expect($response->id)->toBe(17835)
        ->and($response->name)->toBe('b_serverinstance_help_view');
});
