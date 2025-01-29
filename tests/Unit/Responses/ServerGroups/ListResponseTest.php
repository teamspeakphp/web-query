<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\ListResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\ListResponseGroup;

test('from', function () {
    $response = ListResponse::from([[
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
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->groups->toBeArray()->toHaveCount(1)
        ->groups->each->toBeInstanceOf(ListResponseGroup::class);
});
