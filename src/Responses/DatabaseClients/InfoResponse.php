<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\DatabaseClients;

use DateTimeImmutable;

final readonly class InfoResponse
{
    private function __construct(
        public string $base64HashClientUid,
        public DateTimeImmutable $created,
        public int $databaseId,
        public string $description,
        public string $flagAvatar,
        public DateTimeImmutable $lastConnected,
        public string $lastIpAddress,
        public int $monthBytesDownloaded,
        public int $monthBytesUploaded,
        public string $nickname,
        public int $totalBytesDownloaded,
        public int $totalBytesUploaded,
        public int $totalConnections,
        public string $uniqueIdentifier,
    ) {}

    /**
     * @param  array{0: array{client_base64HashClientUID: string, client_created: string, client_database_id: string, client_description: string, client_flag_avatar: string, client_lastconnected: string, client_lastip: string, client_month_bytes_downloaded: string, client_month_bytes_uploaded: string, client_nickname: string, client_total_bytes_downloaded: string, client_total_bytes_uploaded: string, client_totalconnections: string, client_unique_identifier: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes[0]['client_base64HashClientUID'],
            DateTimeImmutable::createFromTimestamp((int) $attributes[0]['client_created']),
            (int) $attributes[0]['client_database_id'],
            $attributes[0]['client_description'],
            $attributes[0]['client_flag_avatar'],
            DateTimeImmutable::createFromTimestamp((int) $attributes[0]['client_lastconnected']),
            $attributes[0]['client_lastip'],
            (int) $attributes[0]['client_month_bytes_downloaded'],
            (int) $attributes[0]['client_month_bytes_uploaded'],
            $attributes[0]['client_nickname'],
            (int) $attributes[0]['client_total_bytes_downloaded'],
            (int) $attributes[0]['client_total_bytes_uploaded'],
            (int) $attributes[0]['client_totalconnections'],
            $attributes[0]['client_unique_identifier'],
        );
    }
}
