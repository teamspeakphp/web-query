<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\VersionResponse;

test('from', function () {
    $response = VersionResponse::from([[
        'version' => '3.13.7',
        'build' => '1666597175',
        'platform' => 'Linux',
    ]]);

    expect($response->version)->toBe('3.13.7')
        ->and($response->build)->toBe('1666597175')
        ->and($response->platform)->toBe('Linux');
});
