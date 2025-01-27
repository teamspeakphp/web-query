<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\ClientType;
use TeamSpeak\WebQuery\Responses\Clients\InfoResponse;

test('from', function () {
    $response = InfoResponse::from([[
        'cid' => '1',
        'client_away' => '0',
        'client_away_message' => '',
        'client_badges' => '',
        'client_base64HashClientUID' => '',
        'client_channel_group_id' => '8',
        'client_channel_group_inherited_channel_id' => '1',
        'client_country' => '',
        'client_created' => '0',
        'client_database_id' => '1',
        'client_default_channel' => '',
        'client_default_token' => '',
        'client_description' => '',
        'client_flag_avatar' => '',
        'client_icon_id' => '0',
        'client_idle_time' => '39760',
        'client_input_hardware' => '0',
        'client_input_muted' => '0',
        'client_integrations' => '',
        'client_is_channel_commander' => '0',
        'client_is_priority_speaker' => '0',
        'client_is_recording' => '0',
        'client_is_talker' => '0',
        'client_lastconnected' => '0',
        'client_login_name' => '',
        'client_meta_data' => '',
        'client_month_bytes_downloaded' => '0',
        'client_month_bytes_uploaded' => '0',
        'client_myteamspeak_avatar' => '',
        'client_myteamspeak_id' => '',
        'client_needed_serverquery_view_power' => '100',
        'client_nickname' => 'serveradmin',
        'client_nickname_phonetic' => '',
        'client_output_hardware' => '0',
        'client_output_muted' => '0',
        'client_outputonly_muted' => '0',
        'client_platform' => 'ServerQuery',
        'client_security_hash' => '',
        'client_servergroups' => '2',
        'client_signed_badges' => '',
        'client_talk_power' => '0',
        'client_talk_request' => '0',
        'client_talk_request_msg' => '',
        'client_total_bytes_downloaded' => '0',
        'client_total_bytes_uploaded' => '0',
        'client_totalconnections' => '0',
        'client_type' => '1',
        'client_unique_identifier' => 'serveradmin',
        'client_version' => 'ServerQuery',
        'client_version_sign' => '',
        'connection_bandwidth_received_last_minute_total' => '0',
        'connection_bandwidth_received_last_second_total' => '0',
        'connection_bandwidth_sent_last_minute_total' => '0',
        'connection_bandwidth_sent_last_second_total' => '0',
        'connection_bytes_received_total' => '0',
        'connection_bytes_sent_total' => '0',
        'connection_client_ip' => '100.100.100.100',
        'connection_connected_time' => '0',
        'connection_filetransfer_bandwidth_received' => '0',
        'connection_filetransfer_bandwidth_sent' => '0',
        'connection_packets_received_total' => '0',
        'connection_packets_sent_total' => '0',
    ]]);

    expect($response)
        ->toBeInstanceOf(InfoResponse::class)
        ->id->toBe(1)
        ->away->toBeFalse()
        ->awayMessage->toBe('')
        ->badges->toBe('')
        ->base64HashClientUID->toBe('')
        ->channelGroupId->toBe(8)
        ->channelGroupInheritedChannelId->toBe(1)
        ->country->toBe('')
        ->created->getTimestamp()->toBe(0)
        ->databaseId->toBe(1)
        ->defaultChannel->toBe('')
        ->defaultToken->toBe('')
        ->description->toBe('')
        ->flagAvatar->toBe('')
        ->iconId->toBe(0)
        ->idleTime->toBe(39760)
        ->inputHardware->toBeFalse()
        ->inputMuted->toBeFalse()
        ->integrations->toBe(0)
        ->channelCommander->toBeFalse()
        ->prioritySpeaker->toBeFalse()
        ->recording->toBeFalse()
        ->talker->toBeFalse()
        ->lastConnected->getTimestamp()->toBe(0)
        ->loginName->toBe('')
        ->metaData->toBe('')
        ->monthBytesDownloaded->toBe(0)
        ->monthBytesUploaded->toBe(0)
        ->myTeamSpeakAvatar->toBe('')
        ->myTeamSpeakId->toBe('')
        ->neededServerQueryViewPower->toBe(100)
        ->nickname->toBe('serveradmin')
        ->nicknamePhonetic->toBe('')
        ->outputHardware->toBeFalse()
        ->outputMuted->toBeFalse()
        ->outputOnlyMuted->toBeFalse()
        ->platform->toBe('ServerQuery')
        ->securityHash->toBe('')
        ->serverGroups->toBe([2])
        ->signedBadges->toBe('')
        ->talkPower->toBe(0)
        ->talkRequest->toBeFalse()
        ->talkRequestMessage->toBe('')
        ->totalBytesDownloaded->toBe(0)
        ->totalBytesUploaded->toBe(0)
        ->totalConnections->toBe(0)
        ->type->toBe(ClientType::Bot)
        ->uniqueIdentifier->toBe('serveradmin')
        ->version->toBe('ServerQuery')
        ->versionSign->toBe('')
        ->bandwidthReceivedLastMinuteTotal->toBe(0)
        ->bandwidthReceivedLastSecondTotal->toBe(0)
        ->bandwidthSentLastMinuteTotal->toBe(0)
        ->bandwidthSentLastSecondTotal->toBe(0)
        ->bytesReceivedTotal->toBe(0)
        ->bytesSentTotal->toBe(0)
        ->ipAddress->toBe('100.100.100.100')
        ->connectedTime->toBe(0)
        ->fileTransferBandwidthReceived->toBe(0)
        ->fileTransferBandwidthSent->toBe(0)
        ->packetsReceivedTotal->toBe(0)
        ->packetsSentTotal->toBe(0);
});
