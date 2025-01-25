<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Channels\FindResponse;
use TeamSpeak\WebQuery\Responses\Channels\FindResponseChannel;

test('from', function () {
    $response = FindResponse::from([[
        'cid' => '1',
        'channel_name' => 'foo',
    ]]);

    expect($response)
        ->toBeInstanceOf(FindResponse::class)
        ->channels->toBeArray()->toHaveCount(1)
        ->channels->each->toBeInstanceOf(FindResponseChannel::class);
});
