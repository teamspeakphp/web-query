<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\WhoAmI;

final readonly class WhoAmIResponse
{
    private function __construct(
        public int $clientChannelId,
        public int $clientDatabaseId,
        public int $clientId,
        public string $clientLoginName,
        public string $clientNickname,
        public int $clientOriginServerId,
        public string $clientUniqueIdentifier,
        public int $virtualServerId,
        public int $virtualServerPort,
        public string $virtualServerStatus,
        public string $virtualServerUniqueIdentifier,
    ) {}

    /**
     * @param  array{0: array{client_channel_id: string, client_database_id: string, client_id: string, client_login_name: string, client_nickname: string, client_origin_server_id: string, client_unique_identifier: string, virtualserver_id: string, virtualserver_port: string, virtualserver_status: string, virtualserver_unique_identifier: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['client_channel_id'],
            (int) $attributes[0]['client_database_id'],
            (int) $attributes[0]['client_id'],
            $attributes[0]['client_login_name'],
            $attributes[0]['client_nickname'],
            (int) $attributes[0]['client_origin_server_id'],
            $attributes[0]['client_unique_identifier'],
            (int) $attributes[0]['virtualserver_id'],
            (int) $attributes[0]['virtualserver_port'],
            $attributes[0]['virtualserver_status'],
            $attributes[0]['virtualserver_unique_identifier'],
        );
    }
}
