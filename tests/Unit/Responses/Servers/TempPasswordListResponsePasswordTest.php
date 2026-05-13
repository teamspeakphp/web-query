<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponsePassword;

test('from', function () {
    $password = TempPasswordListResponsePassword::from([
        'nickname' => 'Guest',
        'uid' => 'abc123==',
        'desc' => 'Guest pass',
        'pw_clear' => 'secret',
        'start' => '1700000000',
        'end' => '1700003600',
        'tcid' => '5',
    ]);

    expect($password->nickname)->toBe('Guest')
        ->and($password->uid)->toBe('abc123==')
        ->and($password->description)->toBe('Guest pass')
        ->and($password->password)->toBe('secret')
        ->and($password->start)->toBe(1700000000)
        ->and($password->end)->toBe(1700003600)
        ->and($password->channelId)->toBe(5);
});
