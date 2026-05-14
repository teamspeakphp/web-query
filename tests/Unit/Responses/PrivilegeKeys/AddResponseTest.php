<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\PrivilegeKeys\AddResponse;

test('from', function () {
    $response = AddResponse::from([[
        'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
    ]]);

    expect($response->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
});
