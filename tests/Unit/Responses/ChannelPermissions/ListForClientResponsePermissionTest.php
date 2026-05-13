<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelPermissions\ListForClientResponsePermission;

test('from with ID', function () {
    $permission = ListForClientResponsePermission::from([
        'cid' => '1',
        'cldbid' => '18',
        'permid' => '42',
        'permnegated' => '0',
        'permskip' => '1',
        'permvalue' => '75',
    ]);

    expect($permission->channelId)->toBe(1)
        ->and($permission->clientDatabaseId)->toBe(18)
        ->and($permission->id)->toBe(42)
        ->and($permission->name)->toBeNull()
        ->and($permission->negated)->toBeFalse()
        ->and($permission->skip)->toBeTrue()
        ->and($permission->value)->toBe(75);
});

test('from with name', function () {
    $permission = ListForClientResponsePermission::from([
        'cid' => '1',
        'cldbid' => '18',
        'permsid' => 'i_channel_needed_join_power',
        'permnegated' => '1',
        'permskip' => '0',
        'permvalue' => '50',
    ]);

    expect($permission->channelId)->toBe(1)
        ->and($permission->clientDatabaseId)->toBe(18)
        ->and($permission->id)->toBeNull()
        ->and($permission->name)->toBe('i_channel_needed_join_power')
        ->and($permission->negated)->toBeTrue()
        ->and($permission->skip)->toBeFalse()
        ->and($permission->value)->toBe(50);
});
