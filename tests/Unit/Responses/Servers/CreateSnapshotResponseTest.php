<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\CreateSnapshotResponse;

test('from without password', function () {
    $response = CreateSnapshotResponse::from([[
        'data' => 'base64encodedsnapshotdata==',
        'version' => '12',
    ]]);

    expect($response->data)->toBe('base64encodedsnapshotdata==')
        ->and($response->version)->toBe('12')
        ->and($response->salt)->toBeNull();
});

test('from with password', function () {
    $response = CreateSnapshotResponse::from([[
        'data' => 'encryptedsnapshotdata==',
        'version' => '12',
        'salt' => 'abc123salt==',
    ]]);

    expect($response->data)->toBe('encryptedsnapshotdata==')
        ->and($response->version)->toBe('12')
        ->and($response->salt)->toBe('abc123salt==');
});
