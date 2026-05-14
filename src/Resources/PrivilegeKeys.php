<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\PrivilegeKeysContract;
use TeamSpeak\WebQuery\Enums\PrivilegeKeyType;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\PrivilegeKeys\AddResponse;
use TeamSpeak\WebQuery\Responses\PrivilegeKeys\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class PrivilegeKeys implements PrivilegeKeysContract
{
    use Concerns\Transportable;

    /**
     * Displays a list of privilege keys available on the virtual server.
     */
    public function list(): ListResponse
    {
        $payload = new Payload(Command::PrivilegeKeyList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{token: string, token_type: string, token_id1: string, token_id2: string, token_description: string, token_created: string, token_customset?: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Creates a new privilege key of the given type.
     *
     * For ServerGroup: id1 = server group ID, id2 = 0.
     * For ChannelGroup: id1 = channel group ID, id2 = channel ID.
     */
    public function add(PrivilegeKeyType $type, int $id1, int $id2 = 0, string $description = '', string $customSet = ''): AddResponse
    {
        $payload = new Payload(
            command: Command::PrivilegeKeyAdd,
            parameters: [
                'tokentype' => $type->value,
                'tokenid1' => $id1,
                'tokenid2' => $id2,
                'tokendescription' => $description ?: null,
                'tokencustomset' => $customSet ?: null,
            ],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{token: string}}> $response */
        $response = $this->transporter->request($payload);

        return AddResponse::from($response->body());
    }

    /**
     * Creates a privilege key that grants membership to a server group.
     */
    public function addServerGroup(int $serverGroupId, string $description = '', string $customSet = ''): AddResponse
    {
        return $this->add(PrivilegeKeyType::ServerGroup, $serverGroupId, 0, $description, $customSet);
    }

    /**
     * Creates a privilege key that grants membership to a channel group in a specific channel.
     */
    public function addChannelGroup(int $channelGroupId, int $channelId, string $description = '', string $customSet = ''): AddResponse
    {
        return $this->add(PrivilegeKeyType::ChannelGroup, $channelGroupId, $channelId, $description, $customSet);
    }

    /**
     * Deletes an existing privilege key.
     */
    public function delete(string $token): void
    {
        $payload = new Payload(
            command: Command::PrivilegeKeyDelete,
            parameters: ['token' => $token],
        );

        $this->transporter->request($payload);
    }

    /**
     * Redeems a privilege key and gains the associated group memberships.
     */
    public function redeem(string $token): void
    {
        $payload = new Payload(
            command: Command::PrivilegeKeyUse,
            parameters: ['token' => $token],
        );

        $this->transporter->request($payload);
    }
}
