<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\SetServerQueryLoginResponse;

test('from', function () {
    $response = SetServerQueryLoginResponse::from([[
        'client_login_password' => '+r\/TQqvR',
    ]]);

    expect($response)
        ->toBeInstanceOf(SetServerQueryLoginResponse::class)
        ->password->toBe('+r\/TQqvR');
});
