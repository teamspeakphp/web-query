<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\GroupNameMode;
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Responses\ChannelGroups\ListResponseGroup;

test('from', function () {
    $group = ListResponseGroup::from([
        'iconid' => '0',
        'n_member_addp' => '50',
        'n_member_removep' => '50',
        'n_modifyp' => '50',
        'name' => 'Channel Admin',
        'namemode' => '0',
        'savedb' => '1',
        'cgid' => '5',
        'sortid' => '10',
        'type' => '1',
    ]);

    expect($group->iconId)->toBe(0)
        ->and($group->neededMemberAddPower)->toBe(50)
        ->and($group->neededMemberRemovePower)->toBe(50)
        ->and($group->neededModifyPower)->toBe(50)
        ->and($group->name)->toBe('Channel Admin')
        ->and($group->nameMode)->toBe(GroupNameMode::None)
        ->and($group->permanent)->toBeTrue()
        ->and($group->id)->toBe(5)
        ->and($group->sortId)->toBe(10)
        ->and($group->type)->toBe(PermissionGroupDatabaseTypes::Regular);
});

test('from with zero sort id', function () {
    $group = ListResponseGroup::from([
        'iconid' => '0',
        'n_member_addp' => '0',
        'n_member_removep' => '0',
        'n_modifyp' => '0',
        'name' => 'Guest',
        'namemode' => '0',
        'savedb' => '0',
        'cgid' => '1',
        'sortid' => '0',
        'type' => '1',
    ]);

    expect($group->sortId)->toBeNull()
        ->and($group->permanent)->toBeFalse();
});
