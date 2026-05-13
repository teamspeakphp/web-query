<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\GetPermissionsResponsePermission;

test('from with ID', function () {
    $permission = GetPermissionsResponsePermission::from([
        'cgid' => '5',
        'permid' => '42',
        'permnegated' => '0',
        'permskip' => '1',
        'permvalue' => '75',
    ]);

    expect($permission->channelGroupId)->toBe(5)
        ->and($permission->id)->toBe(42)
        ->and($permission->name)->toBeNull()
        ->and($permission->negated)->toBeFalse()
        ->and($permission->skip)->toBeTrue()
        ->and($permission->value)->toBe(75);
});

test('from with name', function () {
    $permission = GetPermissionsResponsePermission::from([
        'cgid' => '5',
        'permsid' => 'i_channel_needed_join_power',
        'permnegated' => '1',
        'permskip' => '0',
        'permvalue' => '50',
    ]);

    expect($permission->channelGroupId)->toBe(5)
        ->and($permission->id)->toBeNull()
        ->and($permission->name)->toBe('i_channel_needed_join_power')
        ->and($permission->negated)->toBeTrue()
        ->and($permission->skip)->toBeFalse()
        ->and($permission->value)->toBe(50);
});
