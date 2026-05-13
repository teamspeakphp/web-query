<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponse;
use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponsePassword;

test('from', function () {
    $response = TempPasswordListResponse::from([[
        'nickname' => 'Guest',
        'uid' => 'abc123==',
        'desc' => 'Guest pass',
        'pw_clear' => 'secret',
        'start' => '1700000000',
        'end' => '1700003600',
        'tcid' => '0',
    ]]);

    expect($response->passwords)->toHaveCount(1)
        ->and($response->passwords[0])->toBeInstanceOf(TempPasswordListResponsePassword::class);
});
