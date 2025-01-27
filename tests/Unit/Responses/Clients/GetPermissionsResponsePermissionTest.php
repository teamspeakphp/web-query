<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Clients\GetPermissionsResponsePermission;

test('from with ID', function () {
    $response = GetPermissionsResponsePermission::from([
        'cldbid' => '10',
        'permid' => '176',
        'permnegated' => '0',
        'permskip' => '1',
        'permvalue' => '75',
    ]);

    expect($response)
        ->toBeInstanceOf(GetPermissionsResponsePermission::class)
        ->clientDatabaseId->toBe(10)
        ->id->toBe(176)
        ->name->toBeNull()
        ->negated->toBeFalse()
        ->skip->toBeTrue()
        ->value->toBe(75);
});

test('from with name', function () {
    $response = GetPermissionsResponsePermission::from([
        'cldbid' => '10',
        'permsid' => 'i_client_max_clones_uid',
        'permnegated' => '1',
        'permskip' => '0',
        'permvalue' => '75',
    ]);

    expect($response)
        ->toBeInstanceOf(GetPermissionsResponsePermission::class)
        ->clientDatabaseId->toBe(10)
        ->id->toBeNull()
        ->name->toBe('i_client_max_clones_uid')
        ->negated->toBeTrue()
        ->skip->toBeFalse()
        ->value->toBe(75);
});
