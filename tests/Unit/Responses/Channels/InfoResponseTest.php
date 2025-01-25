<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\Codec;
use TeamSpeak\WebQuery\Responses\Channels\InfoResponse;

test('from', function () {
    $response = InfoResponse::from([[
        'channel_banner_gfx_url' => '',
        'channel_banner_mode' => '0',
        'channel_codec' => '4',
        'channel_codec_is_unencrypted' => '1',
        'channel_codec_latency_factor' => '1',
        'channel_codec_quality' => '0',
        'channel_delete_delay' => '0',
        'channel_description' => '',
        'channel_filepath' => 'files',
        'channel_flag_default' => '0',
        'channel_flag_maxclients_unlimited' => '1',
        'channel_flag_maxfamilyclients_inherited' => '1',
        'channel_flag_maxfamilyclients_unlimited' => '1',
        'channel_flag_password' => '0',
        'channel_flag_permanent' => '1',
        'channel_flag_semi_permanent' => '0',
        'channel_forced_silence' => '0',
        'channel_icon_id' => '0',
        'channel_maxclients' => '-1',
        'channel_maxfamilyclients' => '-1',
        'channel_name' => 'foo',
        'channel_name_phonetic' => '',
        'channel_needed_talk_power' => '75',
        'channel_order' => '1',
        'channel_password' => '',
        'channel_security_salt' => '',
        'channel_topic' => '',
        'channel_unique_identifier' => 'bar',
        'pid' => '0',
        'seconds_empty' => '688423',
    ]]);

    expect($response)
        ->toBeInstanceOf(InfoResponse::class)
        ->bannerGfxUrl->toBe('')
        ->bannerMode->toBe(0)
        ->codec->toBe(Codec::OpusVoice)
        ->codecIsUnencrypted->toBeTrue()
        ->codecLatencyFactor->toBe(1)
        ->codecQuality->toBe(0)
        ->deleteDelay->toBe(0)
        ->description->toBe('')
        ->filepath->toBe('files')
        ->default->toBeFalse()
        ->maxClientsUnlimited->toBeTrue()
        ->maxFamilyClientsInherited->toBeTrue()
        ->maxFamilyClientsUnlimited->toBeTrue()
        ->password->toBeFalse()
        ->permanent->toBeTrue()
        ->semiPermanent->toBeFalse()
        ->forcedSilence->toBeFalse()
        ->iconId->toBe(0)
        ->maxClients->toBe(-1)
        ->maxFamilyClients->toBe(-1)
        ->name->toBe('foo')
        ->namePhonetic->toBe('')
        ->neededTalkPower->toBe(75)
        ->order->toBe(1)
        ->passwordHash->toBe('')
        ->securitySalt->toBe('')
        ->topic->toBe('')
        ->uniqueIdentifier->toBe('bar')
        ->parentId->toBeNull()
        ->secondsEmpty->toBe(688423);
});
