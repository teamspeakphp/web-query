<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\MessagesContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Enums\TextMessageTargetMode;
use TeamSpeak\WebQuery\Responses\Messages\GetResponse;
use TeamSpeak\WebQuery\Responses\Messages\ListResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class Messages implements MessagesContract
{
    use Concerns\Transportable;

    /**
     * Sends a text message to a specified target.
     *
     * If mode **client**, a message will be sent to the client with the specified ID.
     * If mode **channel** or **server**, the unique identifier will be ignored,
     * and a message will be sent to the current channel or server respectively.
     */
    public function send(TextMessageTargetMode $mode, string $message, ?string $uniqueIdentifier = null): void
    {
        $payload = new Payload(
            command: Command::SendTextMessage,
            parameters: ['targetmode' => $mode->value, 'target' => $uniqueIdentifier, 'msg' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Sends a private text message to a client with specified the unique identifier.
     */
    public function sendToClient(string $message, string $uniqueIdentifier): void
    {
        $this->send(TextMessageTargetMode::Client, $message, $uniqueIdentifier);
    }

    /**
     * Sends a text message to the current channel chat.
     */
    public function sendToChannel(string $message): void
    {
        $this->send(TextMessageTargetMode::Channel, $message);
    }

    /**
     * Sends a text message to the current server chat.
     */
    public function sendToServer(string $message): void
    {
        $this->send(TextMessageTargetMode::Server, $message);
    }

    /**
     * Sends a text message to all clients on all virtual servers in the TeamSpeak 3 Server instance.
     */
    public function broadcast(string $message): void
    {
        $payload = new Payload(
            command: Command::Gm,
            parameters: ['msg' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays a list of offline messages you have received.
     *
     * The output contains the senders unique identifier, the messages subject, etc.
     */
    public function listInbox(): ListResponse
    {
        $payload = new Payload(Command::MessageList);

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{msgid: string, cluid: string, subject: string, timestamp: string, flag_read: string}>> $response */
        $response = $this->transporter->request($payload);

        return ListResponse::from($response->body());
    }

    /**
     * Sends an offline message to the client specified by a unique identifier.
     */
    public function sendInbox(string $uniqueIdentifier, string $subject, string $message): void
    {
        $payload = new Payload(
            command: Command::MessageAdd,
            parameters: ['cluid' => $uniqueIdentifier, 'subject' => $subject, 'message' => $message],
        );

        $this->transporter->request($payload);
    }

    /**
     * Deletes an existing offline message with ID from your inbox.
     */
    public function deleteInbox(int $id): void
    {
        $payload = new Payload(
            command: Command::MessageDel,
            parameters: ['msgid' => $id],
        );

        $this->transporter->request($payload);
    }

    /**
     * Displays an existing offline message with ID from your inbox.
     *
     * Please note that this does not automatically set the *flag_read* property of the message.
     */
    public function getInbox(int $id): GetResponse
    {
        $payload = new Payload(
            command: Command::MessageGet,
            parameters: ['msgid' => $id],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<array{0: array{msgid: string, cluid: string, subject: string, message: string}}> $response */
        $response = $this->transporter->request($payload);

        return GetResponse::from($response->body());
    }

    /**
     * Updates the *flag_read* property of the offline message specified with ID.
     *
     * If flag is set to **true**, the message will be marked as read.
     */
    public function updateFlagInbox(int $id, bool $flag): void
    {
        $payload = new Payload(
            command: Command::MessageUpdateFlag,
            parameters: ['msgid' => $id, 'flag' => $flag],
        );

        $this->transporter->request($payload);
    }

    /**
     * Marks the offline message as read.
     */
    public function markAsReadInbox(int $id): void
    {
        $this->updateFlagInbox($id, true);
    }

    /**
     * Marks the offline message as unread.
     */
    public function markAsUnreadInbox(int $id): void
    {
        $this->updateFlagInbox($id, false);
    }
}
