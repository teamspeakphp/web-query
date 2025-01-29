<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetByClientResponse;
use TeamSpeak\WebQuery\Responses\ServerGroups\GetByClientResponseGroup;

test('from', function () {
    $response = GetByClientResponse::from([[
        'name' => 'Server Admin',
        'sgid' => '6',
        'cldbid' => '18',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetByClientResponse::class)
        ->groups->toBeArray()->toHaveCount(1)
        ->groups->each->toBeInstanceOf(GetByClientResponseGroup::class);
});
