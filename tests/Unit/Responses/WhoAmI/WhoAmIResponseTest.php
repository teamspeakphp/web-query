<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\WhoAmI\WhoAmIResponse;

test('from', function () {
    $response = WhoAmIResponse::from([[
        'client_channel_id' => '1',
        'client_database_id' => '1',
        'client_id' => '14',
        'client_login_name' => '<internal>',
        'client_nickname' => 'serveradmin',
        'client_origin_server_id' => '0',
        'client_unique_identifier' => 'serveradmin',
        'virtualserver_id' => '1',
        'virtualserver_port' => '9987',
        'virtualserver_status' => 'online',
        'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
    ]]);

    expect($response->clientChannelId)->toBe(1)
        ->and($response->clientDatabaseId)->toBe(1)
        ->and($response->clientId)->toBe(14)
        ->and($response->clientLoginName)->toBe('<internal>')
        ->and($response->clientNickname)->toBe('serveradmin')
        ->and($response->clientOriginServerId)->toBe(0)
        ->and($response->clientUniqueIdentifier)->toBe('serveradmin')
        ->and($response->virtualServerId)->toBe(1)
        ->and($response->virtualServerPort)->toBe(9987)
        ->and($response->virtualServerStatus)->toBe('online')
        ->and($response->virtualServerUniqueIdentifier)->toBe('dwcJxlwg51mhDP1nlVQh51sIIzo=');
});
