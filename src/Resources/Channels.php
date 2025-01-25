<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ChannelsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Channels\CreateResponse;
use TeamSpeak\WebQuery\Responses\Channels\FindResponse;
use TeamSpeak\WebQuery\Responses\Channels\InfoResponse;
use TeamSpeak\WebQuery\Responses\Channels\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Channels implements ChannelsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of channels created on a virtual server including their ID, order, name, etc.
     *
     * The output can be modified using several command options.
     */
    public function list(
        bool $topic = false,
        bool $flags = false,
        bool $voice = false,
        bool $limits = false,
        bool $icon = false,
        bool $secondsEmpty = false
    ): ListResponse {
        $payload = new Payload(
            command: Command::ChannelList,
            options: ['topic' => $topic, 'flags' => $flags, 'voice' => $voice, 'limits' => $limits, 'icon' => $icon, 'secondsempty' => $secondsEmpty],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{channel_codec?: string, channel_codec_quality?: string, channel_flag_default?: string, channel_flag_password?: string, channel_flag_permanent?: string, channel_flag_semi_permanent?: string, channel_icon_id?: string, channel_maxclients?: string, channel_maxfamilyclients?: string, channel_name: string, channel_needed_subscribe_power: string, channel_needed_talk_power?: string, channel_order: string, channel_topic?: string, cid: string, pid: string, seconds_empty?: string, total_clients: string, total_clients_family?: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Displays detailed configuration information about a channel including ID, topic, description, etc.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     */
    public function info(int $id): InfoResponse
    {
        $payload = new Payload(
            command: Command::ChannelInfo,
            parameters: ['cid' => $id],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{channel_banner_gfx_url: string, channel_banner_mode: string, channel_codec: string, channel_codec_is_unencrypted: string, channel_codec_latency_factor: string, channel_codec_quality: string, channel_delete_delay: string, channel_description: string, channel_filepath: string, channel_flag_default: string, channel_flag_maxclients_unlimited: string, channel_flag_maxfamilyclients_inherited: string, channel_flag_maxfamilyclients_unlimited: string, channel_flag_password: string, channel_flag_permanent: string, channel_flag_semi_permanent: string, channel_forced_silence: string, channel_icon_id: string, channel_maxclients: string, channel_maxfamilyclients: string, channel_name: string, channel_name_phonetic: string, channel_needed_talk_power: string, channel_order: string, channel_password: string, channel_security_salt: string, channel_topic: string, channel_unique_identifier: string, pid: string, seconds_empty: string}}> $response */
        $response = $this->transporter->request($payload);

        return InfoResponse::from($response->body());
    }

    /**
     * Displays a list of channels matching a given name pattern.
     */
    public function find(string $pattern): FindResponse
    {
        $payload = new Payload(
            command: Command::ChannelFind,
            parameters: ['pattern' => $pattern],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cid: string, channel_name: string}>> $response */
        $response = $this->transporter->request($payload);

        return FindResponse::from($response->body());
    }

    /**
     * Moves a channel to a new parent channel with the ID.
     *
     * If order is specified, the channel will be sorted right under
     * the channel with the specified ID. If order is set to **0**,
     * the channel will be sorted right below the new parent.
     */
    public function move(
        int $id,
        int $parentId,
        ?int $order = null
    ): void {
        $payload = new Payload(
            command: Command::ChannelMove,
            parameters: ['cid' => $id, 'cpid' => $parentId, 'order' => $order],
        );

        $this->transporter->request($payload);
    }

    /**
     * Creates a new channel using the given properties and displays its ID.
     *
     * Note that this command accepts multiple properties which means
     * that you are able to specify all settings of the new channel at once.
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     *
     * @param  array<string, string|int|bool>|array{}  $properties
     */
    public function create(string $name, array $properties = []): CreateResponse
    {
        $payload = new Payload(
            command: Command::ChannelCreate,
            parameters: [
                ...$properties,
                'channel_name' => $name,
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{cid: string}}> $response */
        $response = $this->transporter->request($payload);

        return CreateResponse::from($response->body());
    }

    /**
     * Deletes an existing channel by ID.
     *
     * If force is set to **true**, the channel will be deleted even if there
     * are clients within. The clients will be kicked to the default channel
     * with an appropriate reason message.
     */
    public function delete(int $id, bool $force = false): void
    {
        $payload = new Payload(
            command: Command::ChannelDelete,
            parameters: ['cid' => $id, 'force' => $force],
        );

        $this->transporter->request($payload);
    }

    /**
     * Changes a channels configuration using given properties.
     *
     * Note that this command accepts multiple properties, which means that
     * you are able to change all settings of the channel specified with channel ID at once.
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     *
     * @param  array<string, string|int|bool>  $properties
     */
    public function edit(int $id, array $properties): void
    {
        $payload = new Payload(
            command: Command::ChannelEdit,
            parameters: [
                ...$properties,
                'cid' => $id,
            ],
        );

        $this->transporter->request($payload);
    }
}
