<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

use TeamSpeak\WebQuery\Enums\Codec;

final readonly class InfoResponse
{
    private function __construct(
        public string $bannerGfxUrl,
        public int $bannerMode,
        public Codec $codec,
        public bool $codecIsUnencrypted,
        public int $codecLatencyFactor,
        public int $codecQuality,
        public int $deleteDelay,
        public string $description,
        public string $filepath,
        public bool $default,
        public bool $maxClientsUnlimited,
        public bool $maxFamilyClientsInherited,
        public bool $maxFamilyClientsUnlimited,
        public bool $password,
        public bool $permanent,
        public bool $semiPermanent,
        public bool $forcedSilence,
        public int $iconId,
        public int $maxClients,
        public int $maxFamilyClients,
        public string $name,
        public string $namePhonetic,
        public int $neededTalkPower,
        public int $order,
        public string $passwordHash,
        public string $securitySalt,
        public string $topic,
        public string $uniqueIdentifier,
        public ?int $parentId,
        public int $secondsEmpty,
    ) {}

    /**
     * @param  array{0: array{channel_banner_gfx_url: string, channel_banner_mode: string, channel_codec: string, channel_codec_is_unencrypted: string, channel_codec_latency_factor: string, channel_codec_quality: string, channel_delete_delay: string, channel_description: string, channel_filepath: string, channel_flag_default: string, channel_flag_maxclients_unlimited: string, channel_flag_maxfamilyclients_inherited: string, channel_flag_maxfamilyclients_unlimited: string, channel_flag_password: string, channel_flag_permanent: string, channel_flag_semi_permanent: string, channel_forced_silence: string, channel_icon_id: string, channel_maxclients: string, channel_maxfamilyclients: string, channel_name: string, channel_name_phonetic: string, channel_needed_talk_power: string, channel_order: string, channel_password: string, channel_security_salt: string, channel_topic: string, channel_unique_identifier: string, pid: string, seconds_empty: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['channel_banner_gfx_url'],
            (int) $attributes[0]['channel_banner_mode'],
            Codec::from((int) $attributes[0]['channel_codec']),
            (bool) $attributes[0]['channel_codec_is_unencrypted'],
            (int) $attributes[0]['channel_codec_latency_factor'],
            (int) $attributes[0]['channel_codec_quality'],
            (int) $attributes[0]['channel_delete_delay'],
            $attributes[0]['channel_description'],
            $attributes[0]['channel_filepath'],
            (bool) $attributes[0]['channel_flag_default'],
            (bool) $attributes[0]['channel_flag_maxclients_unlimited'],
            (bool) $attributes[0]['channel_flag_maxfamilyclients_inherited'],
            (bool) $attributes[0]['channel_flag_maxfamilyclients_unlimited'],
            (bool) $attributes[0]['channel_flag_password'],
            (bool) $attributes[0]['channel_flag_permanent'],
            (bool) $attributes[0]['channel_flag_semi_permanent'],
            (bool) $attributes[0]['channel_forced_silence'],
            (int) $attributes[0]['channel_icon_id'],
            (int) $attributes[0]['channel_maxclients'],
            (int) $attributes[0]['channel_maxfamilyclients'],
            $attributes[0]['channel_name'],
            $attributes[0]['channel_name_phonetic'],
            (int) $attributes[0]['channel_needed_talk_power'],
            (int) $attributes[0]['channel_order'],
            $attributes[0]['channel_password'],
            $attributes[0]['channel_security_salt'],
            $attributes[0]['channel_topic'],
            $attributes[0]['channel_unique_identifier'],
            $attributes[0]['pid'] !== '0' ? (int) $attributes[0]['pid'] : null,
            (int) $attributes[0]['seconds_empty'],
        );
    }
}
