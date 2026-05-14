<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\ListResponse;
use TeamSpeak\WebQuery\Responses\Servers\ListResponseServer;

test('from', function () {
    $response = ListResponse::from([[
        'virtualserver_id' => '1',
        'virtualserver_status' => 'online',
        'virtualserver_clientsonline' => '5',
        'virtualserver_queryclientsonline' => '1',
        'virtualserver_maxclients' => '32',
        'virtualserver_uptime' => '3600',
        'virtualserver_name' => 'TeamSpeak Server',
        'virtualserver_autostart' => '1',
        'virtualserver_machine_id' => '',
        'virtualserver_port' => '9987',
    ]]);

    expect($response->servers)->toHaveCount(1)
        ->and($response->servers[0])->toBeInstanceOf(ListResponseServer::class)
        ->and($response->servers[0]->id)->toBe(1)
        ->and($response->servers[0]->clientsOnline)->toBe(5)
        ->and($response->servers[0]->uniqueIdentifier)->toBeNull();
});

test('from short response', function () {
    $response = ListResponse::from([[
        'virtualserver_id' => '2',
        'virtualserver_status' => 'online',
        'virtualserver_name' => 'TeamSpeak Server',
        'virtualserver_port' => '9987',
    ]]);

    expect($response->servers[0]->id)->toBe(2)
        ->and($response->servers[0]->clientsOnline)->toBeNull()
        ->and($response->servers[0]->queryClientsOnline)->toBeNull()
        ->and($response->servers[0]->maxClients)->toBeNull()
        ->and($response->servers[0]->uptime)->toBeNull()
        ->and($response->servers[0]->autostart)->toBeNull()
        ->and($response->servers[0]->machineId)->toBeNull();
});
