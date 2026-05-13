<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\CodecEncryptionMode;
use TeamSpeak\WebQuery\Enums\HostBannerMode;
use TeamSpeak\WebQuery\Enums\HostMessageMode;
use TeamSpeak\WebQuery\Responses\Servers\InfoResponse;

test('from', function () {
    $response = InfoResponse::from([[
        'virtualserver_antiflood_points_needed_command_block' => '150',
        'virtualserver_antiflood_points_needed_ip_block' => '250',
        'virtualserver_antiflood_points_needed_plugin_block' => '350',
        'virtualserver_antiflood_points_tick_reduce' => '5',
        'virtualserver_channel_temp_delete_delay_default' => '0',
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
        'virtualserver_log_channel' => '0',
        'virtualserver_log_client' => '1',
        'virtualserver_log_filetransfer' => '0',
        'virtualserver_log_permissions' => '1',
        'virtualserver_log_query' => '0',
        'virtualserver_log_server' => '1',
        'virtualserver_max_download_total_bandwidth' => '18446744073709551615',
        'virtualserver_max_upload_total_bandwidth' => '18446744073709551615',
        'virtualserver_maxclients' => '32',
        'virtualserver_min_android_version' => '0',
        'virtualserver_min_client_version' => '0',
        'virtualserver_min_ios_version' => '0',
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
        'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
        'virtualserver_uptime' => '3600',
        'virtualserver_version' => '3.13.7 [Build: 1666597175]',
        'virtualserver_weblist_enabled' => '1',
        'virtualserver_welcomemessage' => 'Welcome!',
    ]]);

    expect($response->name)->toBe('TeamSpeak Server')
        ->and($response->id)->toBe(1)
        ->and($response->port)->toBe(9987)
        ->and($response->clientsOnline)->toBe(5)
        ->and($response->maxClients)->toBe(32)
        ->and($response->codecEncryptionMode)->toBe(CodecEncryptionMode::Individual)
        ->and($response->hostbannerMode)->toBe(HostBannerMode::NoAdjust)
        ->and($response->hostmessageMode)->toBe(HostMessageMode::None)
        ->and($response->password)->toBeFalse()
        ->and($response->logClient)->toBeTrue()
        ->and($response->prioritySpeakerDimmModificator)->toBe(-18.0)
        ->and($response->uniqueIdentifier)->toBe('dwcJxlwg51mhDP1nlVQh51sIIzo=')
        ->and($response->welcomemessage)->toBe('Welcome!');
});
