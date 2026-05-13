<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Logs\ListResponse;
use TeamSpeak\WebQuery\Responses\Logs\ListResponseLog;

test('from', function () {
    $response = ListResponse::from([[
        'l' => '2024-06-22 20:03:05.123456|INFO    |VirtualServer |1  |client connected',
    ]]);

    expect($response->logs)->toBeArray()->toHaveCount(1)
        ->and($response->logs[0])->toBeInstanceOf(ListResponseLog::class);
});
