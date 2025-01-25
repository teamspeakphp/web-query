<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Channels\CreateResponse;
use TeamSpeak\WebQuery\Responses\Channels\FindResponse;
use TeamSpeak\WebQuery\Responses\Channels\InfoResponse;
use TeamSpeak\WebQuery\Responses\Channels\ListResponse;

interface ChannelsContract
{
    /**
     * Displays a list of channels created on a virtual server including their ID, order, name, etc.
     *
     * The output can be modified using several command options.
     */
    public function list(bool $topic = false, bool $flags = false, bool $voice = false, bool $limits = false, bool $icon = false, bool $secondsEmpty = false): ListResponse;

    /**
     * Displays detailed configuration information about a channel including ID, topic, description, etc.
     *
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     */
    public function info(int $id): InfoResponse;

    /**
     * Displays a list of channels matching a given name pattern.
     */
    public function find(string $pattern): FindResponse;

    /**
     * Moves a channel to a new parent channel with the ID.
     *
     * If order is specified, the channel will be sorted right under
     * the channel with the specified ID. If order is set to **0**,
     * the channel will be sorted right below the new parent.
     */
    public function move(int $id, int $parentId, ?int $order = null): void;

    /**
     * Creates a new channel using the given properties and displays its ID.
     *
     * Note that this command accepts multiple properties which means
     * that you are able to specify all settings of the new channel at once.
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     *
     * @param  array<string, string|int|bool>|array{}  $properties
     */
    public function create(string $name, array $properties = []): CreateResponse;

    /**
     * Deletes an existing channel by ID.
     *
     * If force is set to **true**, the channel will be deleted even if there
     * are clients within. The clients will be kicked to the default channel
     * with an appropriate reason message.
     */
    public function delete(int $id, bool $force = false): void;

    /**
     * Changes a channels configuration using given properties.
     *
     * Note that this command accepts multiple properties, which means that
     * you are able to change all settings of the channel specified with channel ID at once.
     * For detailed information, see {@see \TeamSpeak\WebQuery\Enums\ChannelProperties}.
     *
     * @param  array<string, string|int|bool>  $properties
     */
    public function edit(int $id, array $properties): void;
}
