<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Clients;

use DateTimeImmutable;
use TeamSpeak\WebQuery\Enums\ClientType;

final readonly class ListResponseClient
{
    /**
     * @param  list<int>|null  $serverGroups
     */
    private function __construct(
        public int $channelId,
        public int $id,
        public ?bool $away,
        public ?string $awayMessage,
        public ?string $badges,
        public ?int $channelGroupId,
        public ?int $channelGroupInheritedChannelId,
        public ?string $country,
        public ?DateTimeImmutable $created,
        public int $databaseId,
        public ?bool $talking,
        public ?int $idleTime,
        public ?bool $inputHardware,
        public ?bool $inputMuted,
        public ?bool $channelCommander,
        public ?bool $prioritySpeaker,
        public ?bool $recording,
        public ?bool $talker,
        public ?DateTimeImmutable $lastConnected,
        public string $nickname,
        public ?bool $outputHardware,
        public ?bool $outputMuted,
        public ?string $platform,
        public ?array $serverGroups,
        public ?int $talkPower,
        public ClientType $type,
        public ?string $uniqueIdentifier,
        public ?string $version,
        public ?string $ipAddress,
    ) {}

    /**
     * @param  array{cid: string, clid: string, client_away?: string, client_away_message?: string, client_badges?: string, client_channel_group_id?: string, client_channel_group_inherited_channel_id?: string, client_country?: string, client_created?: string, client_database_id: string, client_flag_talking?: string, client_idle_time?: string, client_input_hardware?: string, client_input_muted?: string, client_is_channel_commander?: string, client_is_priority_speaker?: string, client_is_recording?: string, client_is_talker?: string, client_lastconnected?: string, client_nickname: string, client_output_hardware?: string, client_output_muted?: string, client_platform?: string, client_servergroups?: string, client_talk_power?: string, client_type: string, client_unique_identifier?: string, client_version?: string, connection_client_ip?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes['cid'],
            (int) $attributes['clid'],
            isset($attributes['client_away']) ? (bool) $attributes['client_away'] : null,
            $attributes['client_away_message'] ?? null,
            $attributes['client_badges'] ?? null,
            isset($attributes['client_channel_group_id']) ? (int) $attributes['client_channel_group_id'] : null,
            isset($attributes['client_channel_group_inherited_channel_id']) ? (int) $attributes['client_channel_group_inherited_channel_id'] : null,
            $attributes['client_country'] ?? null,
            isset($attributes['client_created']) ? DateTimeImmutable::createFromTimestamp((int) $attributes['client_created']) : null,
            (int) $attributes['client_database_id'],
            isset($attributes['client_flag_talking']) ? (bool) $attributes['client_flag_talking'] : null,
            isset($attributes['client_idle_time']) ? (int) $attributes['client_idle_time'] : null,
            isset($attributes['client_input_hardware']) ? (bool) $attributes['client_input_hardware'] : null,
            isset($attributes['client_input_muted']) ? (bool) $attributes['client_input_muted'] : null,
            isset($attributes['client_is_channel_commander']) ? (bool) $attributes['client_is_channel_commander'] : null,
            isset($attributes['client_is_priority_speaker']) ? (bool) $attributes['client_is_priority_speaker'] : null,
            isset($attributes['client_is_recording']) ? (bool) $attributes['client_is_recording'] : null,
            isset($attributes['client_is_talker']) ? (bool) $attributes['client_is_talker'] : null,
            isset($attributes['client_lastconnected']) ? DateTimeImmutable::createFromTimestamp((int) $attributes['client_lastconnected']) : null,
            $attributes['client_nickname'],
            isset($attributes['client_output_hardware']) ? (bool) $attributes['client_output_hardware'] : null,
            isset($attributes['client_output_muted']) ? (bool) $attributes['client_output_muted'] : null,
            $attributes['client_platform'] ?? null,
            isset($attributes['client_servergroups'])
                ? array_map(fn (string $value): int => (int) $value, explode(',', $attributes['client_servergroups']))
                : null,
            isset($attributes['client_talk_power']) ? (int) $attributes['client_talk_power'] : null,
            ClientType::from((int) $attributes['client_type']),
            $attributes['client_unique_identifier'] ?? null,
            $attributes['client_version'] ?? null,
            $attributes['connection_client_ip'] ?? null,
        );
    }
}
