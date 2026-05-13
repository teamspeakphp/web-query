<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts\Resources;

use TeamSpeak\WebQuery\Responses\Servers\BindingListResponse;
use TeamSpeak\WebQuery\Responses\Servers\ConnectionInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\CreateResponse;
use TeamSpeak\WebQuery\Responses\Servers\HostInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\IdGetByPortResponse;
use TeamSpeak\WebQuery\Responses\Servers\InfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\InstanceInfoResponse;
use TeamSpeak\WebQuery\Responses\Servers\ListResponse;
use TeamSpeak\WebQuery\Responses\Servers\TempPasswordListResponse;
use TeamSpeak\WebQuery\Responses\Servers\VersionResponse;

interface ServersContract
{
    public function version(): VersionResponse;

    public function hostInfo(): HostInfoResponse;

    public function instanceInfo(): InstanceInfoResponse;

    /** @param  array<string, string|int|bool|null>  $properties */
    public function editInstance(array $properties): void;

    public function bindingList(): BindingListResponse;

    public function list(bool $uid = false, bool $short = false, bool $all = false, bool $onlyOffline = false): ListResponse;

    public function idGetByPort(int $port): IdGetByPortResponse;

    public function delete(int $id): void;

    /** @param  array<string, string|int|bool|null>  $properties */
    public function create(string $name, array $properties = []): CreateResponse;

    public function start(int $id): void;

    public function stop(int $id, ?string $reasonMessage = null): void;

    public function stopProcess(?string $reasonMessage = null): void;

    public function info(): InfoResponse;

    public function connectionInfo(): ConnectionInfoResponse;

    public function addTempPassword(string $password, string $description, int $duration, int $channelId = 0, string $channelPassword = ''): void;

    public function deleteTempPassword(string $password): void;

    public function listTempPasswords(): TempPasswordListResponse;

    /** @param  array<string, string|int|bool|null>  $properties */
    public function edit(array $properties): void;
}
