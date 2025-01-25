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

    /**
     * Displays a list of client identities known by the server including their database ID, last nickname, etc.
     */
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

    /**
     * Displays detailed database information about a client including unique ID, creation date, etc.
     */
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

    /**
     * Displays a list of client database IDs matching a given pattern.
     *
     * You can either search for a clients last known nickname, or his unique
     * identity by using the **$uid** option. The pattern parameter can include
     * regular characters and SQL wildcard characters (e.g., %).
     */
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

    /**
     * Displays a list of client database IDs matching a given name pattern.
     *
     * The pattern parameter can include regular characters and SQL wildcard
     * characters (e.g., %).
     */
    public function findByName(string $pattern): FindResponse
    {
        return $this->find($pattern);
    }

    /**
     * Displays a list of client database IDs matching a given unique ID pattern.
     *
     * The pattern parameter can include regular characters and SQL wildcard
     * characters (e.g., %).
     */
    public function findByUid(string $pattern): FindResponse
    {
        return $this->find($pattern, true);
    }

    /**
     * Changes a clients settings using given properties.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ClientProperties}.
     *
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

    /**
     * Changes a client description.
     */
    public function editDescription(int $databaseId, string $description): void
    {
        $this->edit($databaseId, ['client_description' => $description]);
    }

    /**
     * Deletes a clients properties from the database.
     */
    public function delete(int $databaseId): void
    {
        $payload = new Payload(
            command: Command::ClientDbDelete,
            parameters: ['cldbid' => $databaseId],
        );

        $this->transporter->request($payload);
    }
}
