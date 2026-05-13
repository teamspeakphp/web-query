<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Servers\BindingListResponse;
use TeamSpeak\WebQuery\Responses\Servers\ConnectionInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\CreateResponse;
use TeamSpeak\WebQuery\Responses\Servers\CreateSnapshotResponse;
use TeamSpeak\WebQuery\Responses\Servers\HostInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\IdGetByPortResponse;
use TeamSpeak\WebQuery\Responses\Servers\InfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\InstanceInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\ListResponse;
use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponse;
use TeamSpeak\WebQuery\Responses\Servers\VersionResponse;

interface ServersContract
{
    /**
     * Displays the version information of the server.
     */
    public function version(): VersionResponse;

    /**
     * Displays detailed connection statistics of the server instance.
     */
    public function hostInfo(): HostInfoResponse;

    /**
     * Displays the server instance configuration.
     */
    public function instanceInfo(): InstanceInfoResponse;

    /**
     * Changes the server instance configuration.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function editInstance(array $properties): void;

    /**
     * Displays a list of IP addresses and ports the server instance is listening on.
     */
    public function bindingList(): BindingListResponse;

    /**
     * Displays a list of virtual servers.
     */
    public function list(bool $uid = false, bool $short = false, bool $all = false, bool $onlyOffline = false): ListResponse;

    /**
     * Returns the virtual server ID for the given UDP port.
     */
    public function idGetByPort(int $port): IdGetByPortResponse;

    /**
     * Deletes the virtual server with the given ID.
     */
    public function delete(int $id): void;

    /**
     * Creates a new virtual server with the given name and optional properties.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function create(string $name, array $properties = []): CreateResponse;

    /**
     * Starts the virtual server with the given ID.
     */
    public function start(int $id): void;

    /**
     * Stops the virtual server with the given ID.
     */
    public function stop(int $id, ?string $reasonMessage = null): void;

    /**
     * Stops the entire TeamSpeak 3 server process.
     */
    public function stopProcess(?string $reasonMessage = null): void;

    /**
     * Displays detailed configuration of the selected virtual server.
     */
    public function info(): InfoResponse;

    /**
     * Displays detailed connection statistics of the selected virtual server.
     */
    public function connectionInfo(): ConnectionInfoResponse;

    /**
     * Adds a temporary password for the virtual server.
     *
     * Clients connecting with this password are moved to the specified channel.
     */
    public function addTempPassword(string $password, string $description, int $duration, int $channelId = 0, string $channelPassword = ''): void;

    /**
     * Deletes a temporary password from the virtual server.
     */
    public function deleteTempPassword(string $password): void;

    /**
     * Displays a list of active temporary passwords for the virtual server.
     */
    public function listTempPasswords(): TempPasswordListResponse;

    /**
     * Changes the configuration of the selected virtual server.
     *
     * @param  array<string, string|int|bool|null>  $properties
     */
    public function edit(array $properties): void;

    /**
     * Creates a snapshot of the selected virtual server.
     *
     * Returns the snapshot hash and data which can be used with deploySnapshot.
     */
    public function createSnapshot(): CreateSnapshotResponse;

    /**
     * Deploys a previously created virtual server snapshot.
     */
    public function deploySnapshot(string $snapshot): void;
}
