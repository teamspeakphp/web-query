<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\BansContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\Bans\CreateResponse;
use TeamSpeak\WebQuery\Responses\Bans\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Bans implements BansContract
{
    use Concerns\Transportable;

    /**
     * Bans the client specified with ID from the server.
     *
     * Please note that this will create two separate ban rules for the targeted clients IP address and his unique identifier.
     */
    public function client(int $id, ?int $seconds = 0, ?string $reason = null): CreateResponse
    {
        $payload = new Payload(
            command: Command::BanClient,
            parameters: ['clid' => $id, 'time' => $seconds, 'banreason' => $reason],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{banid: string}>> $response */
        $response = $this->transporter->request($payload);

        return CreateResponse::from($response->body());
    }

    /**
     * Displays a list of active bans on the selected virtual server.
     */
    public function list(): ListResponse
    {
        $payload = new Payload(Command::BanList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{banid: string, created: string, duration: string, enforcements: string, invokercldbid: string, invokername: string, invokeruid: string, ip: string, lastnickname: string, mytsid: string, name: string, reason: string, uid: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Adds a new ban rule on the selected virtual server.
     *
     * All parameters are optional but at least one of the following must be set:
     * **ipAddressRegexp**, **nameRegexp**, or **uniqueIdentifier**.
     */
    public function add(?string $ipAddressRegexp = null, ?string $nameRegexp = null, ?string $uniqueIdentifier = null, ?int $seconds = null, ?string $reason = null): CreateResponse
    {
        $payload = new Payload(
            command: Command::BanAdd,
            parameters: ['ip' => $ipAddressRegexp, 'name' => $nameRegexp, 'uid' => $uniqueIdentifier, 'time' => $seconds, 'banreason' => $reason],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{banid: string}>> $response */
        $response = $this->transporter->request($payload);

        return CreateResponse::from($response->body());
    }

    /**
     * Deletes the ban rule with ID from the server.
     */
    public function delete(int $id): void
    {
        $payload = new Payload(
            command: Command::BanDel,
            parameters: ['banid' => $id],
        );

        $this->transporter->request($payload);
    }

    /**
     * Deletes all active ban rules from the server.
     */
    public function deleteAll(): void
    {
        $this->transporter->request(new Payload(Command::BanDelAll));
    }
}
