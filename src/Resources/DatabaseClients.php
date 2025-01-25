<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\DatabaseClientsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\DatabaseClients\FindResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\InfoResponse;
use TeamSpeak\WebQuery\Responses\DatabaseClients\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class DatabaseClients implements DatabaseClientsContract
{
    use Concerns\Transportable;

    public function list(?int $offset = null, ?int $limit = null, bool $count = false): ListResponse
    {
        $payload = new Payload(
            command: Command::ClientDbList,
            parameters: ['start' => $offset, 'duration' => $limit],
            options: ['count' => $count],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string, client_created: string, client_description: string, client_lastconnected: string, client_lastip: string, client_login_name: string, client_nickname: string, client_totalconnections: string, client_unique_identifier: string, count?: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    public function info(int $databaseId): InfoResponse
    {
        $payload = new Payload(
            command: Command::ClientDbInfo,
            parameters: ['cldbid' => $databaseId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{client_base64HashClientUID: string, client_created: string, client_database_id: string, client_description: string, client_flag_avatar: string, client_lastconnected: string, client_lastip: string, client_month_bytes_downloaded: string, client_month_bytes_uploaded: string, client_nickname: string, client_total_bytes_downloaded: string, client_total_bytes_uploaded: string, client_totalconnections: string, client_unique_identifier: string}}> $response */
        $response = $this->transporter->request($payload);

        return InfoResponse::from($response->body());
    }

    public function find(string $pattern, bool $uid = false): FindResponse
    {
        $payload = new Payload(
            command: Command::ClientDbFind,
            parameters: ['pattern' => $pattern],
            options: ['uid' => $uid],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string}>> $response */
        $response = $this->transporter->request($payload);

        return FindResponse::from($response->body());
    }

    public function findByName(string $pattern): FindResponse
    {
        return $this->find($pattern);
    }

    public function findByUid(string $pattern): FindResponse
    {
        return $this->find($pattern, true);
    }

    /**
     * @param  array<string, string>  $properties
     */
    public function edit(int $databaseId, array $properties): void
    {
        $payload = new Payload(
            command: Command::ClientDbEdit,
            parameters: [...$properties, 'cldbid' => $databaseId],
        );

        $this->transporter->request($payload);
    }

    public function editDescription(int $databaseId, string $description): void
    {
        $this->edit($databaseId, ['client_description' => $description]);
    }

    public function delete(int $databaseId): void
    {
        $payload = new Payload(
            command: Command::ClientDbDelete,
            parameters: ['cldbid' => $databaseId],
        );

        $this->transporter->request($payload);
    }
}
