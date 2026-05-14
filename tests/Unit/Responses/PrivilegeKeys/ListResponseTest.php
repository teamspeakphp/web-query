<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\PrivilegeKeys\ListResponse;
use TeamSpeak\WebQuery\Responses\PrivilegeKeys\ListResponseKey;

test('from', function () {
    $response = ListResponse::from([[
        'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
        'token_type' => '0',
        'token_id1' => '6',
        'token_id2' => '0',
        'token_description' => 'Admin key',
        'token_created' => '1700000000',
    ]]);

    expect($response->keys)->toHaveCount(1)
        ->and($response->keys[0])->toBeInstanceOf(ListResponseKey::class);
});
