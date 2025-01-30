<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetClientsResponseClient;

test('from', function () {
    $response = GetClientsResponseClient::from([
        'cldbid' => '18',
        'client_nickname' => 'foo',
        'client_unique_identifier' => 'bar',
    ]);

    expect($response)
        ->toBeInstanceOf(GetClientsResponseClient::class)
        ->databaseId->toBe(18)
        ->nickname->toBe('foo')
        ->uniqueIdentifier->toBe('bar');
});

test('from required', function () {
    $response = GetClientsResponseClient::from([
        'cldbid' => '18',
    ]);

    expect($response)
        ->toBeInstanceOf(GetClientsResponseClient::class)
        ->databaseId->toBe(18)
        ->nickname->toBeNull()
        ->uniqueIdentifier->toBeNull();
});
