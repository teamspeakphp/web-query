<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\DatabaseClients\InfoResponse;

test('from', function () {
    $response = InfoResponse::from([[
        'client_base64HashClientUID' => 'foobar',
        'client_created' => '123456789',
        'client_database_id' => '10',
        'client_description' => 'description',
        'client_flag_avatar' => '',
        'client_lastconnected' => '123456789',
        'client_lastip' => '100.100.100.100',
        'client_month_bytes_downloaded' => '0',
        'client_month_bytes_uploaded' => '0',
        'client_nickname' => 'bar',
        'client_total_bytes_downloaded' => '0',
        'client_total_bytes_uploaded' => '0',
        'client_totalconnections' => '0',
        'client_unique_identifier' => 'foobar',
    ]]);

    expect($response)
        ->toBeInstanceOf(InfoResponse::class)
        ->base64HashClientUid->toBe('foobar')
        ->created->getTimestamp()->toBe(123456789)
        ->databaseId->toBe(10)
        ->description->toBe('description')
        ->flagAvatar->toBe('')
        ->lastConnected->getTimestamp()->toBe(123456789)
        ->lastIpAddress->toBe('100.100.100.100')
        ->monthBytesDownloaded->toBe(0)
        ->monthBytesUploaded->toBe(0)
        ->nickname->toBe('bar')
        ->totalBytesDownloaded->toBe(0)
        ->totalBytesUploaded->toBe(0)
        ->totalConnections->toBe(0)
        ->uniqueIdentifier->toBe('foobar');
});
