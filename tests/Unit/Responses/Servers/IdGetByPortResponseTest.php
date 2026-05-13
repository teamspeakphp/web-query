<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\IdGetByPortResponse;

test('from', function () {
    $response = IdGetByPortResponse::from([['server_id' => '1']]);

    expect($response->serverId)->toBe(1);
});
