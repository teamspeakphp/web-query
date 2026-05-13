<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\CreateResponse;

test('from with token', function () {
    $response = CreateResponse::from([[
        'sid' => '2',
        'virtualserver_port' => '9988',
        'token' => 'abc123',
    ]]);

    expect($response->id)->toBe(2)
        ->and($response->port)->toBe(9988)
        ->and($response->token)->toBe('abc123');
});

test('from without token', function () {
    $response = CreateResponse::from([[
        'sid' => '2',
        'virtualserver_port' => '9988',
    ]]);

    expect($response->token)->toBeNull();
});
