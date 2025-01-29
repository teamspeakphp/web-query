<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\GroupNameMode;
use TeamSpeak\WebQuery\Enums\PermissionGroupDatabaseTypes;
use TeamSpeak\WebQuery\Responses\ServerGroups\ListResponseGroup;

test('from', function () {
    $response = ListResponseGroup::from([
        'iconid' => '300',
        'n_member_addp' => '75',
        'n_member_removep' => '75',
        'n_modifyp' => '75',
        'name' => 'Server Admin',
        'namemode' => '0',
        'savedb' => '1',
        'sgid' => '3',
        'sortid' => '0',
        'type' => '0',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseGroup::class)
        ->iconId->toBe(300)
        ->neededMemberAddPower->toBe(75)
        ->neededMemberRemovePower->toBe(75)
        ->neededModifyPower->toBe(75)
        ->name->toBe('Server Admin')
        ->nameMode->toBe(GroupNameMode::None)
        ->permanent->toBeTrue()
        ->id->toBe(3)
        ->sortId->toBeNull()
        ->type->toBe(PermissionGroupDatabaseTypes::Template);
});
