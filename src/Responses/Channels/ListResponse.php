<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Channels;

final readonly class ListResponse
{
    /**
     * @param  list<ListResponseChannel>  $channels
     */
    private function __construct(public array $channels) {}

    /**
     * Create a new response from the given attributes.
     *
     * @param  list<array{channel_codec?: string, channel_codec_quality?: string, channel_flag_default?: string, channel_flag_password?: string, channel_flag_permanent?: string, channel_flag_semi_permanent?: string, channel_icon_id?: string, channel_maxclients?: string, channel_maxfamilyclients?: string, channel_name: string, channel_needed_subscribe_power: string, channel_needed_talk_power?: string, channel_order: string, channel_topic?: string, cid: string, pid: string, seconds_empty?: string, total_clients: string, total_clients_family?: string}>  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            array_map(static fn (array $result): ListResponseChannel => ListResponseChannel::from($result), $attributes)
        );
    }
}
