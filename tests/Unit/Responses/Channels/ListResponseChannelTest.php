<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Channels\ListResponseChannel;

test('from', function () {
    $response = ListResponseChannel::from([
        'channel_name' => 'foo',
        'channel_needed_subscribe_power' => '75',
        'channel_order' => '0',
        'cid' => '5',
        'pid' => '1',
        'total_clients' => '0',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseChannel::class)
        ->name->toBe('foo')
        ->neededSubscribePower->toBe(75)
        ->order->toBe(0)
        ->id->toBe(5)
        ->parentId->toBe(1)
        ->totalClients->toBe(0);
});
