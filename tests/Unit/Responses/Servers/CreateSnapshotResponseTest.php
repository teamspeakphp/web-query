<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\CreateSnapshotResponse;

test('from', function () {
    $response = CreateSnapshotResponse::from([[
        'hash' => 'abc123',
        'virtualserver_snapshot' => 'base64encodedsnapshotdata==',
    ]]);

    expect($response->hash)->toBe('abc123')
        ->and($response->data)->toBe('base64encodedsnapshotdata==');
});
