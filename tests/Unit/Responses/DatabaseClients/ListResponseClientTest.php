<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\DatabaseClients\ListResponseClient;

test('from', function () {
    $response = ListResponseClient::from([
        'cldbid' => '2',
        'client_created' => '123456789',
        'client_description' => '',
        'client_lastconnected' => '123456789',
        'client_lastip' => '',
        'client_login_name' => '',
        'client_nickname' => 'foo',
        'client_totalconnections' => '0',
        'client_unique_identifier' => 'bar',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseClient::class)
        ->databaseId->toBe(2)
        ->created->getTimestamp()->toBe(123456789)
        ->description->toBe('')
        ->lastConnected->getTimestamp()->toBe(123456789)
        ->lastIpAddress->toBe('')
        ->loginName->toBe('')
        ->nickname->toBe('foo')
        ->totalConnections->toBe(0)
        ->uniqueIdentifier->toBe('bar');
});
