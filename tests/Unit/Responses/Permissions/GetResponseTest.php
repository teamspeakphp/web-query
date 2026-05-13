<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\GetResponse;

test('from', function () {
    $response = GetResponse::from([[
        'permid' => '17835',
        'permsid' => 'b_serverinstance_help_view',
        'permvalue' => '1',
    ]]);

    expect($response->id)->toBe(17835)
        ->and($response->name)->toBe('b_serverinstance_help_view')
        ->and($response->value)->toBe(1);
});
