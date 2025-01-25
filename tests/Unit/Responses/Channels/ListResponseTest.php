<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Channels\ListResponse;
use TeamSpeak\WebQuery\Responses\Channels\ListResponseChannel;

test('from', function () {
    $response = ListResponse::from([[
        'channel_name' => 'foo',
        'channel_needed_subscribe_power' => '75',
        'channel_order' => '0',
        'cid' => '5',
        'pid' => '0',
        'total_clients' => '0',
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->channels->toBeArray()->toHaveCount(1)
        ->channels->each->toBeInstanceOf(ListResponseChannel::class);
});
