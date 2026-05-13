<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\ResetResponse;

test('from', function () {
    $response = ResetResponse::from([[
        'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
    ]]);

    expect($response->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
});
