<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

use TeamSpeak\WebQuery\Enums\Codec;

final readonly class ListResponseChannel
{
    private function __construct(
        public ?Codec $codec,
        public ?int $codecQuality,
        public ?bool $default,
        public ?bool $password,
        public ?bool $permanent,
        public ?bool $semiPermanent,
        public ?int $iconId,
        public ?int $maxClients,
        public ?int $maxFamilyClients,
        public string $name,
        public int $neededSubscribePower,
        public ?int $neededTalkPower,
        public int $order,
        public ?string $topic,
        public int $id,
        public ?int $parentId,
        public ?int $secondsEmpty,
        public int $totalClients,
        public ?int $totalClientsFamily,
    ) {}

    /**
     * Create a new channel from the given attributes.
     *
     * @param  array{channel_codec?: string, channel_codec_quality?: string, channel_flag_default?: string, channel_flag_password?: string, channel_flag_permanent?: string, channel_flag_semi_permanent?: string, channel_icon_id?: string, channel_maxclients?: string, channel_maxfamilyclients?: string, channel_name: string, channel_needed_subscribe_power: string, channel_needed_talk_power?: string, channel_order: string, channel_topic?: string, cid: string, pid: string, seconds_empty?: string, total_clients: string, total_clients_family?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            isset($attributes['channel_codec']) ? Codec::from((int) $attributes['channel_codec']) : null,
            isset($attributes['channel_codec_quality']) ? (int) $attributes['channel_codec_quality'] : null,
            isset($attributes['channel_flag_default']) ? (bool) $attributes['channel_flag_default'] : null,
            isset($attributes['channel_flag_password']) ? (bool) $attributes['channel_flag_password'] : null,
            isset($attributes['channel_flag_permanent']) ? (bool) $attributes['channel_flag_permanent'] : null,
            isset($attributes['channel_flag_semi_permanent']) ? (bool) $attributes['channel_flag_semi_permanent'] : null,
            isset($attributes['channel_icon_id']) ? (int) $attributes['channel_icon_id'] : null,
            isset($attributes['channel_maxclients']) ? (int) $attributes['channel_maxclients'] : null,
            isset($attributes['channel_maxfamilyclients']) ? (int) $attributes['channel_maxfamilyclients'] : null,
            $attributes['channel_name'],
            (int) $attributes['channel_needed_subscribe_power'],
            isset($attributes['channel_needed_talk_power']) ? (int) $attributes['channel_needed_talk_power'] : null,
            (int) $attributes['channel_order'],
            $attributes['channel_topic'] ?? null,
            (int) $attributes['cid'],
            $attributes['pid'] !== '0' ? (int) $attributes['pid'] : null,
            isset($attributes['seconds_empty']) ? (int) $attributes['seconds_empty'] : null,
            (int) $attributes['total_clients'],
            isset($attributes['total_clients_family']) ? (int) $attributes['total_clients_family'] : null,
        );
    }
}
