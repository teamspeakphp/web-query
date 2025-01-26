<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Enums\TextMessageTargetMode;
use TeamSpeak\WebQuery\Responses\Messages\GetResponse;
use TeamSpeak\WebQuery\Responses\Messages\ListResponse;

interface MessagesContract
{
    /**
     * Sends a text message to a specified target.
     *
     * If mode is **client**, a message will be sent to the client with the specified ID.
     * If mode is **channel** or **server**, the ID will be ignored,
     * and a message will be sent to the current channel or server respectively.
     */
    public function send(TextMessageTargetMode $mode, string $message, ?int $id = null): void;

    /**
     * Sends a private text message to the client with the specified ID.
     */
    public function sendToClient(string $message, int $id): void;

    /**
     * Sends a text message to the current channel chat.
     */
    public function sendToChannel(string $message): void;

    /**
     * Sends a text message to the current server chat.
     */
    public function sendToServer(string $message): void;

    /**
     * Sends a text message to all clients on all virtual servers in the TeamSpeak 3 Server instance.
     */
    public function broadcast(string $message): void;

    /**
     * Displays a list of offline messages you have received.
     *
     * The output contains the senders unique identifier, the messages subject, etc.
     */
    public function listInbox(): ListResponse;

    /**
     * Sends an offline message to the client specified by a unique identifier.
     */
    public function sendInbox(string $uniqueIdentifier, string $subject, string $message): void;

    /**
     * Deletes an existing offline message with ID from your inbox.
     */
    public function deleteInbox(int $id): void;

    /**
     * Displays an existing offline message with ID from your inbox.
     *
     * Please note that this does not automatically set the *flag_read* property of the message.
     */
    public function getInbox(int $id): GetResponse;

    /**
     * Updates the *flag_read* property of the offline message specified with ID.
     *
     * If flag is set to **true**, the message will be marked as read.
     */
    public function updateFlagInbox(int $id, bool $flag): void;

    /**
     * Marks the offline message as read.
     */
    public function markAsReadInbox(int $id): void;

    /**
     * Marks the offline message as unread.
     */
    public function markAsUnreadInbox(int $id): void;
}
