<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\PermissionsContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Permissions\FindResponse;
use TeamSpeak\WebQuery\Responses\Permissions\GetIdByNameResponse;
use TeamSpeak\WebQuery\Responses\Permissions\GetResponse;
use TeamSpeak\WebQuery\Responses\Permissions\ListResponse;
use TeamSpeak\WebQuery\Responses\Permissions\OverviewResponse;
use TeamSpeak\WebQuery\Responses\Permissions\ResetResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Permissions implements PermissionsContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of all permissions available on the server.
     */
    public function list(): ListResponse
    {
        $payload = new Payload(Command::PermissionList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{permid: string, permname: string, permdesc: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Returns the ID of a permission specified by name.
     */
    public function getIdByName(string $name): GetIdByNameResponse
    {
        $payload = new Payload(
            command: Command::PermIdGetByName,
            parameters: ['permsid' => $name],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{permid: string, permsid: string}}> $response */
        $response = $this->transporter->request($payload);

        return GetIdByNameResponse::from($response->body());
    }

    /**
     * Displays all permissions for a client in a specific channel.
     *
     * A permission can be specified by ID or name.
     */
    public function overview(int $channelId, int $clientDatabaseId, string|int $permission): OverviewResponse
    {
        $payload = new Payload(
            command: Command::PermOverview,
            parameters: [
                'cid' => $channelId,
                'cldbid' => $clientDatabaseId,
                ...is_int($permission) ? ['permid' => $permission] : ['permsid' => $permission],
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{t: string, id1: string, id2: string, p: string, v: string, n: string, s: string}>> $response */
        $response = $this->transporter->request($payload);

        return OverviewResponse::from($response->body());
    }

    /**
     * Displays the current value of a permission for the selected virtual server.
     *
     * A permission can be specified by ID or name.
     */
    public function get(string|int $id): GetResponse
    {
        $payload = new Payload(
            command: Command::PermGet,
            parameters: [
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{permid: string, permsid: string, permvalue: string}}> $response */
        $response = $this->transporter->request($payload);

        return GetResponse::from($response->body());
    }

    /**
     * Displays all clients and groups assigned a specific permission.
     *
     * A permission can be specified by ID or name.
     */
    public function find(string|int $id): FindResponse
    {
        $payload = new Payload(
            command: Command::PermFind,
            parameters: [
                ...is_int($id) ? ['permid' => $id] : [],
                ...is_string($id) ? ['permsid' => $id] : [],
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{t: string, id1: string, id2: string, p: string}>> $response */
        $response = $this->transporter->request($payload);

        return FindResponse::from($response->body());
    }

    /**
     * Resets the permission settings of the virtual server to default values.
     *
     * Returns a new administrator privilege key.
     */
    public function reset(): ResetResponse
    {
        $payload = new Payload(Command::PermReset);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{token: string}}> $response */
        $response = $this->transporter->request($payload);

        return ResetResponse::from($response->body());
    }
}
