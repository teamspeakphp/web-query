<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Bans\ListResponseBan;

test('from', function () {
    $response = ListResponseBan::from([
        'banid' => '1',
        'created' => '1719081785',
        'duration' => '0',
        'enforcements' => '0',
        'invokercldbid' => '3',
        'invokername' => 'foo',
        'invokeruid' => 'bar',
        'ip' => '',
        'lastnickname' => 'foobar',
        'mytsid' => '',
        'name' => '',
        'reason' => '',
        'uid' => 'test',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseBan::class)
        ->id->toBe(1)
        ->created->getTimestamp()->toBe(1719081785)
        ->duration->toBe(0)
        ->enforcements->toBe(0)
        ->invokerDatabaseId->toBe(3)
        ->invokerName->toBe('foo')
        ->invokerUniqueIdentifier->toBe('bar')
        ->ipAddress->toBeNull()
        ->lastNickname->toBe('foobar')
        ->myTeamSpeakId->toBeNull()
        ->name->toBeNull()
        ->reason->toBeNull()
        ->uniqueIdentifier->toBe('test');
});
