<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\ClientType;
use TeamSpeak\WebQuery\Responses\Clients\ListResponseClient;

test('from', function () {
    $response = ListResponseClient::from([
        'cid' => '1',
        'clid' => '841',
        'client_away' => '0',
        'client_away_message' => '',
        'client_badges' => '',
        'client_channel_group_id' => '8',
        'client_channel_group_inherited_channel_id' => '1',
        'client_country' => 'UA',
        'client_created' => '1719072439',
        'client_database_id' => '10',
        'client_flag_talking' => '0',
        'client_idle_time' => '934978',
        'client_input_hardware' => '1',
        'client_input_muted' => '0',
        'client_is_channel_commander' => '0',
        'client_is_priority_speaker' => '0',
        'client_is_recording' => '0',
        'client_is_talker' => '0',
        'client_lastconnected' => '1737935291',
        'client_nickname' => 'Smith',
        'client_output_hardware' => '1',
        'client_output_muted' => '1',
        'client_platform' => 'OS X',
        'client_servergroups' => '10,14',
        'client_talk_power' => '75',
        'client_type' => '0',
        'client_unique_identifier' => 'foo',
        'client_version' => '3.6.2 [Build: 1695203293]',
        'connection_client_ip' => '100.100.100.100',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseClient::class)
        ->channelId->toBe(1)
        ->id->toBe(841)
        ->away->toBeFalse()
        ->awayMessage->toBe('')
        ->badges->toBe('')
        ->channelGroupId->toBe(8)
        ->channelGroupInheritedChannelId->toBe(1)
        ->country->toBe('UA')
        ->created->getTimestamp()->toBe(1719072439)
        ->databaseId->toBe(10)
        ->talking->toBeFalse()
        ->idleTime->toBe(934978)
        ->inputHardware->toBeTrue()
        ->inputMuted->toBeFalse()
        ->channelCommander->toBeFalse()
        ->prioritySpeaker->toBeFalse()
        ->recording->toBeFalse()
        ->talker->toBeFalse()
        ->lastConnected->getTimestamp()->toBe(1737935291)
        ->nickname->toBe('Smith')
        ->outputHardware->toBeTrue()
        ->outputMuted->toBeTrue()
        ->platform->toBe('OS X')
        ->serverGroups->toBe([10, 14])
        ->talkPower->toBe(75)
        ->type->toBe(ClientType::Client)
        ->uniqueIdentifier->toBe('foo')
        ->version->toBe('3.6.2 [Build: 1695203293]')
        ->ipAddress->toBe('100.100.100.100');
});
