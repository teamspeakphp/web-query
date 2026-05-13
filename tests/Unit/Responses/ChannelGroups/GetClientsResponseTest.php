<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\GetClientsResponse;
use TeamSpeak\WebQuery\Responses\ChannelGroups\GetClientsResponseClient;

test('from', function () {
    $response = GetClientsResponse::from([[
        'cid' => '1',
        'cldbid' => '18',
        'cgid' => '5',
    ]]);

    expect($response->clients)->toBeArray()->toHaveCount(1)
        ->and($response->clients[0])->toBeInstanceOf(GetClientsResponseClient::class);
});
