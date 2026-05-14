<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\PrivilegeKeys\ListResponseKey;

test('from', function () {
    $key = ListResponseKey::from([
        'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
        'token_type' => '0',
        'token_id1' => '6',
        'token_id2' => '0',
        'token_description' => 'Admin key',
        'token_created' => '1700000000',
    ]);

    expect($key->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=')
        ->and($key->type)->toBe(0)
        ->and($key->id1)->toBe(6)
        ->and($key->id2)->toBe(0)
        ->and($key->description)->toBe('Admin key')
        ->and($key->createdAt)->toBe(1700000000)
        ->and($key->customSet)->toBe('');
});

test('from with custom set', function () {
    $key = ListResponseKey::from([
        'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
        'token_type' => '1',
        'token_id1' => '5',
        'token_id2' => '3',
        'token_description' => 'VIP channel',
        'token_created' => '1700000000',
        'token_customset' => 'custom',
    ]);

    expect($key->type)->toBe(1)
        ->and($key->id2)->toBe(3)
        ->and($key->customSet)->toBe('custom');
});
