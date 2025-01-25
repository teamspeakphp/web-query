<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Bans\ListResponse;
use TeamSpeak\WebQuery\Responses\Bans\ListResponseBan;

test('from', function () {
    $response = ListResponse::from([[
        'banid' => '1',
        'created' => '1719081785',
        'duration' => '0',
        'enforcements' => '0',
        'invokercldbid' => '3',
        'invokername' => 'foo',
        'invokeruid' => 'bar',
        'ip' => '',
        'lastnickname' => 'foobar',
        'mytsid' => '',
        'name' => '',
        'reason' => '',
        'uid' => 'test',
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->bans->toBeArray()->toHaveCount(1)
        ->bans->each->toBeInstanceOf(ListResponseBan::class);
});
