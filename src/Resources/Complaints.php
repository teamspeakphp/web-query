<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ComplaintsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Complaints\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Complaints implements ComplaintsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of complaints on the selected virtual server.
     *
     * If targetClientDatabaseId is specified, only complaints about that client are shown.
     */
    public function list(?int $targetClientDatabaseId = null): ListResponse
    {
        $payload = new Payload(
            command: Command::ComplainList,
            parameters: ['tcldbid' => $targetClientDatabaseId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{tcldbid: string, tclname: string, fcldbid: string, fclname: string, message: string, timestamp: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Submits a complaint about the client with the given database ID.
     */
    public function add(int $targetClientDatabaseId, string $message): void
    {
        $payload = new Payload(
            command: Command::ComplainAdd,
            parameters: ['tcldbid' => $targetClientDatabaseId, 'message' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Deletes all complaints about the client with the given database ID.
     */
    public function deleteAll(int $targetClientDatabaseId): void
    {
        $payload = new Payload(
            command: Command::ComplainDelAll,
            parameters: ['tcldbid' => $targetClientDatabaseId],
        );

        $this->transporter->request($payload);
    }

    /**
     * Deletes the complaint about targetClientDatabaseId submitted by fromClientDatabaseId.
     */
    public function delete(int $targetClientDatabaseId, int $fromClientDatabaseId): void
    {
        $payload = new Payload(
            command: Command::ComplainDel,
            parameters: ['tcldbid' => $targetClientDatabaseId, 'fcldbid' => $fromClientDatabaseId],
        );

        $this->transporter->request($payload);
    }
}
