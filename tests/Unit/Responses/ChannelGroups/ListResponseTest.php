<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\ListResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\ListResponseGroup;

test('from', function () {
    $response = ListResponse::from([[
        'iconid' => '0',
        'n_member_addp' => '50',
        'n_member_removep' => '50',
        'n_modifyp' => '50',
        'name' => 'Channel Admin',
        'namemode' => '0',
        'savedb' => '1',
        'cgid' => '5',
        'sortid' => '0',
        'type' => '1',
    ]]);

    expect($response->groups)->toBeArray()->toHaveCount(1)
        ->and($response->groups[0])->toBeInstanceOf(ListResponseGroup::class);
});
