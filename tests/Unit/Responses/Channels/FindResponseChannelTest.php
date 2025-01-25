<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Channels\FindResponseChannel;

test('from', function () {
    $response = FindResponseChannel::from([
        'cid' => '1',
        'channel_name' => 'foo',
    ]);

    expect($response)
        ->toBeInstanceOf(FindResponseChannel::class)
        ->id->toBe(1)
        ->name->toBe('foo');
});
