<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\GetClientsResponseClient;

test('from', function () {
    $client = GetClientsResponseClient::from([
        'cid' => '1',
        'cldbid' => '18',
        'cgid' => '5',
    ]);

    expect($client->channelId)->toBe(1)
        ->and($client->clientDatabaseId)->toBe(18)
        ->and($client->channelGroupId)->toBe(5);
});
