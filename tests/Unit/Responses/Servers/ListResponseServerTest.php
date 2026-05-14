<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\ListResponseServer;

test('from', function () {
    $server = ListResponseServer::from([
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
    ]);

    expect($server->id)->toBe(1)
        ->and($server->status)->toBe('online')
        ->and($server->clientsOnline)->toBe(5)
        ->and($server->queryClientsOnline)->toBe(1)
        ->and($server->maxClients)->toBe(32)
        ->and($server->uptime)->toBe(3600)
        ->and($server->name)->toBe('TeamSpeak Server')
        ->and($server->autostart)->toBeTrue()
        ->and($server->machineId)->toBe('')
        ->and($server->port)->toBe(9987)
        ->and($server->uniqueIdentifier)->toBeNull();
});

test('from with uid', function () {
    $server = ListResponseServer::from([
        'virtualserver_id' => '1',
        'virtualserver_status' => 'online',
        'virtualserver_clientsonline' => '0',
        'virtualserver_queryclientsonline' => '0',
        'virtualserver_maxclients' => '32',
        'virtualserver_uptime' => '0',
        'virtualserver_name' => 'TS3',
        'virtualserver_autostart' => '0',
        'virtualserver_machine_id' => '',
        'virtualserver_port' => '9987',
        'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
    ]);

    expect($server->uniqueIdentifier)->toBe('dwcJxlwg51mhDP1nlVQh51sIIzo=');
});

test('from short', function () {
    $server = ListResponseServer::from([
        'virtualserver_id' => '2',
        'virtualserver_status' => 'online',
        'virtualserver_name' => 'TS3',
        'virtualserver_port' => '9987',
    ]);

    expect($server->id)->toBe(2)
        ->and($server->clientsOnline)->toBeNull()
        ->and($server->queryClientsOnline)->toBeNull()
        ->and($server->maxClients)->toBeNull()
        ->and($server->uptime)->toBeNull()
        ->and($server->autostart)->toBeNull()
        ->and($server->machineId)->toBeNull()
        ->and($server->uniqueIdentifier)->toBeNull();
});
