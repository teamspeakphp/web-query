<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\CodecEncryptionMode;
use TeamSpeak\WebQuery\Enums\HostBannerMode;
use TeamSpeak\WebQuery\Enums\HostMessageMode;
use TeamSpeak\WebQuery\Responses\Servers\InfoResponse;

test('from', function () {
    $response = InfoResponse::from([[
        'connection_bandwidth_received_last_minute_total' => '87',
        'connection_bandwidth_received_last_second_total' => '83',
        'connection_bandwidth_sent_last_minute_total' => '79',
        'connection_bandwidth_sent_last_second_total' => '81',
        'connection_bytes_received_control' => '1000',
        'connection_bytes_received_keepalive' => '2000',
        'connection_bytes_received_speech' => '3000',
        'connection_bytes_received_total' => '6000',
        'connection_bytes_sent_control' => '4000',
        'connection_bytes_sent_keepalive' => '5000',
        'connection_bytes_sent_speech' => '6000',
        'connection_bytes_sent_total' => '15000',
        'connection_filetransfer_bandwidth_received' => '0',
        'connection_filetransfer_bandwidth_sent' => '0',
        'connection_filetransfer_bytes_received_total' => '100',
        'connection_filetransfer_bytes_sent_total' => '200',
        'connection_packets_received_control' => '10',
        'connection_packets_received_keepalive' => '20',
        'connection_packets_received_speech' => '30',
        'connection_packets_received_total' => '60',
        'connection_packets_sent_control' => '11',
        'connection_packets_sent_keepalive' => '21',
        'connection_packets_sent_speech' => '31',
        'connection_packets_sent_total' => '63',
        'virtualserver_antiflood_points_needed_command_block' => '150',
        'virtualserver_antiflood_points_needed_ip_block' => '250',
        'virtualserver_antiflood_points_needed_plugin_block' => '350',
        'virtualserver_antiflood_points_tick_reduce' => '5',
        'virtualserver_ask_for_privilegekey' => '0',
        'virtualserver_autostart' => '1',
        'virtualserver_capability_extensions' => '',
        'virtualserver_channel_temp_delete_delay_default' => '0',
        'virtualserver_channelsonline' => '68',
        'virtualserver_client_connections' => '2',
        'virtualserver_clientsonline' => '5',
        'virtualserver_codec_encryption_mode' => '0',
        'virtualserver_complain_autoban_count' => '5',
        'virtualserver_complain_autoban_time' => '1200',
        'virtualserver_complain_remove_time' => '3600',
        'virtualserver_created' => '1700000000',
        'virtualserver_default_channel_admin_group' => '5',
        'virtualserver_default_channel_group' => '8',
        'virtualserver_default_server_group' => '8',
        'virtualserver_download_quota' => '0',
        'virtualserver_file_storage_class' => '',
        'virtualserver_filebase' => '/tmp/ts3',
        'virtualserver_flag_password' => '0',
        'virtualserver_hostbanner_gfx_interval' => '0',
        'virtualserver_hostbanner_gfx_url' => '',
        'virtualserver_hostbanner_mode' => '0',
        'virtualserver_hostbanner_url' => '',
        'virtualserver_hostbutton_gfx_url' => '',
        'virtualserver_hostbutton_tooltip' => '',
        'virtualserver_hostbutton_url' => '',
        'virtualserver_hostmessage' => '',
        'virtualserver_hostmessage_mode' => '0',
        'virtualserver_icon_id' => '0',
        'virtualserver_id' => '1',
        'virtualserver_ip' => '0.0.0.0, ::',
        'virtualserver_log_channel' => '0',
        'virtualserver_log_client' => '1',
        'virtualserver_log_filetransfer' => '0',
        'virtualserver_log_permissions' => '1',
        'virtualserver_log_query' => '0',
        'virtualserver_log_server' => '1',
        'virtualserver_machine_id' => '',
        'virtualserver_max_download_total_bandwidth' => '0',
        'virtualserver_max_upload_total_bandwidth' => '0',
        'virtualserver_maxclients' => '32',
        'virtualserver_min_android_version' => '0',
        'virtualserver_min_client_version' => '0',
        'virtualserver_min_clients_in_channel_before_forced_silence' => '1000',
        'virtualserver_min_ios_version' => '0',
        'virtualserver_month_bytes_downloaded' => '1000',
        'virtualserver_month_bytes_uploaded' => '500',
        'virtualserver_name' => 'TeamSpeak Server',
        'virtualserver_name_phonetic' => '',
        'virtualserver_needed_identity_security_level' => '8',
        'virtualserver_nickname' => '',
        'virtualserver_password' => '',
        'virtualserver_platform' => 'Linux',
        'virtualserver_port' => '9987',
        'virtualserver_priority_speaker_dimm_modificator' => '-18.0000',
        'virtualserver_query_client_connections' => '1',
        'virtualserver_queryclientsonline' => '1',
        'virtualserver_reserved_slots' => '0',
        'virtualserver_status' => 'online',
        'virtualserver_total_bytes_downloaded' => '2000000',
        'virtualserver_total_bytes_uploaded' => '1000000',
        'virtualserver_total_packetloss_control' => '0.0000',
        'virtualserver_total_packetloss_keepalive' => '0.0000',
        'virtualserver_total_packetloss_speech' => '0.0000',
        'virtualserver_total_packetloss_total' => '0.0000',
        'virtualserver_total_ping' => '43.0000',
        'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
        'virtualserver_upload_quota' => '0',
        'virtualserver_uptime' => '3600',
        'virtualserver_version' => '3.13.7 [Build: 1666597175]',
        'virtualserver_weblist_enabled' => '1',
        'virtualserver_welcomemessage' => 'Welcome!',
    ]]);

    expect($response->name)->toBe('TeamSpeak Server')
        ->and($response->id)->toBe(1)
        ->and($response->port)->toBe(9987)
        ->and($response->ip)->toBe('0.0.0.0, ::')
        ->and($response->clientsOnline)->toBe(5)
        ->and($response->channelsOnline)->toBe(68)
        ->and($response->maxClients)->toBe(32)
        ->and($response->autostart)->toBeTrue()
        ->and($response->askForPrivilegekey)->toBeFalse()
        ->and($response->machineId)->toBe('')
        ->and($response->capabilityExtensions)->toBe('')
        ->and($response->fileStorageClass)->toBe('')
        ->and($response->codecEncryptionMode)->toBe(CodecEncryptionMode::Individual)
        ->and($response->hostbannerMode)->toBe(HostBannerMode::NoAdjust)
        ->and($response->hostmessageMode)->toBe(HostMessageMode::None)
        ->and($response->password)->toBeFalse()
        ->and($response->logClient)->toBeTrue()
        ->and($response->prioritySpeakerDimmModificator)->toBe(-18.0)
        ->and($response->totalPing)->toBe(43.0)
        ->and($response->totalPacketlossTotal)->toBe(0.0)
        ->and($response->monthBytesDownloaded)->toBe(1000)
        ->and($response->monthBytesUploaded)->toBe(500)
        ->and($response->totalBytesDownloaded)->toBe(2000000)
        ->and($response->totalBytesUploaded)->toBe(1000000)
        ->and($response->minClientsInChannelBeforeForcedSilence)->toBe(1000)
        ->and($response->connectionBytesReceivedTotal)->toBe(6000)
        ->and($response->connectionBytesSentTotal)->toBe(15000)
        ->and($response->connectionPacketsReceivedTotal)->toBe(60)
        ->and($response->connectionPacketsSentTotal)->toBe(63)
        ->and($response->connectionFiletransferBytesReceivedTotal)->toBe(100)
        ->and($response->connectionFiletransferBytesSentTotal)->toBe(200)
        ->and($response->uniqueIdentifier)->toBe('dwcJxlwg51mhDP1nlVQh51sIIzo=')
        ->and($response->welcomemessage)->toBe('Welcome!');
});
