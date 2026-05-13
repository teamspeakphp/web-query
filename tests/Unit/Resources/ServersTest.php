<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\Servers;
use TeamSpeak\WebQuery\Transporters\HttpTransporter;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = ApiKey::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('teamspeak.com'),
        Headers::withXApiKey($apiKey),
    );
});

test('version', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['version' => '3.13.7', 'build' => '1666597175', 'platform' => 'Linux']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->version()->version)->toBe('3.13.7');
});

test('host info', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'instance_uptime' => '86400',
            'host_timestamp_utc' => '1700000000',
            'virtualservers_running_total' => '1',
            'virtualservers_total_maxclients' => '32',
            'virtualservers_total_clients_online' => '5',
            'virtualservers_total_channels_online' => '3',
            'connection_filetransfer_bandwidth_sent' => '0',
            'connection_filetransfer_bandwidth_received' => '0',
            'connection_filetransfer_bytes_sent_total' => '0',
            'connection_filetransfer_bytes_received_total' => '0',
            'connection_packets_sent_total' => '1000',
            'connection_bytes_sent_total' => '50000',
            'connection_packets_received_total' => '900',
            'connection_bytes_received_total' => '45000',
            'connection_bandwidth_sent_last_second_total' => '100',
            'connection_bandwidth_sent_last_minute_total' => '6000',
            'connection_bandwidth_received_last_second_total' => '90',
            'connection_bandwidth_received_last_minute_total' => '5400',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->hostInfo()->uptime)->toBe(86400);
});

test('instance info', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'serverinstance_database_version' => '27',
            'serverinstance_filetransfer_port' => '30033',
            'serverinstance_max_download_total_bandwidth' => '18446744073709551615',
            'serverinstance_max_upload_total_bandwidth' => '18446744073709551615',
            'serverinstance_guest_serverquery_group' => '1',
            'serverinstance_serverquery_flood_commands' => '50',
            'serverinstance_serverquery_flood_time' => '3',
            'serverinstance_serverquery_ban_time' => '600',
            'serverinstance_template_serveradmin_group' => '3',
            'serverinstance_template_serverdefault_group' => '8',
            'serverinstance_template_channeladmin_group' => '5',
            'serverinstance_template_channeldefault_group' => '4',
            'serverinstance_permissions_version' => '19',
            'serverinstance_pending_connections_per_ip' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->instanceInfo()->fileTransferPort)->toBe(30033);
});

test('edit instance', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['serverinstance_filetransfer_port' => '30033']);

            return true;
        })->andReturn($response);

    $resource->editInstance(['serverinstance_filetransfer_port' => '30033']);
})->doesNotPerformAssertions();

test('binding list', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['ip' => '0.0.0.0'], ['ip' => '::']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->bindingList()->bindings)->toHaveCount(2);
});

test('list', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sid' => '1',
            'virtualserver_status' => 'online',
            'virtualserver_clientsonline' => '5',
            'virtualserver_queryclientsonline' => '1',
            'virtualserver_maxclients' => '32',
            'virtualserver_uptime' => '3600',
            'virtualserver_name' => 'TeamSpeak Server',
            'virtualserver_autostart' => '1',
            'virtualserver_machine_id' => '',
            'virtualserver_port' => '9987',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['-uid' => '', '-short' => '', '-all' => '', '-onlyoffline' => '']);

            return true;
        })->andReturn($response);

    expect($resource->list(uid: true, short: true, all: true, onlyOffline: true)->servers)->toHaveCount(1);
});

test('list default sends empty body', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sid' => '1',
            'virtualserver_status' => 'online',
            'virtualserver_clientsonline' => '5',
            'virtualserver_queryclientsonline' => '1',
            'virtualserver_maxclients' => '32',
            'virtualserver_uptime' => '3600',
            'virtualserver_name' => 'TeamSpeak Server',
            'virtualserver_autostart' => '1',
            'virtualserver_machine_id' => '',
            'virtualserver_port' => '9987',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBe('');

            return true;
        })->andReturn($response);

    expect($resource->list()->servers)->toHaveCount(1);
});

test('id get by port', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['server_id' => '1']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['virtualserver_port' => '9987']);

            return true;
        })->andReturn($response);

    expect($resource->idGetByPort(9987)->serverId)->toBe(1);
});

test('delete', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['sid' => '1']);

            return true;
        })->andReturn($response);

    $resource->delete(1);
})->doesNotPerformAssertions();

test('create', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['sid' => '2', 'virtualserver_port' => '9988', 'token' => 'abc123']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['virtualserver_name' => 'New Server']);

            return true;
        })->andReturn($response);

    $result = $resource->create('New Server');
    expect($result->id)->toBe(2)
        ->and($result->port)->toBe(9988)
        ->and($result->token)->toBe('abc123');
});

test('start', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['sid' => '1']);

            return true;
        })->andReturn($response);

    $resource->start(1);
})->doesNotPerformAssertions();

test('stop', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['sid' => '1', 'reasonmsg' => 'Maintenance']);

            return true;
        })->andReturn($response);

    $resource->stop(1, 'Maintenance');
})->doesNotPerformAssertions();

test('stop without reason', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['sid' => '1']);

            return true;
        })->andReturn($response);

    $resource->stop(1);
})->doesNotPerformAssertions();

test('stop process', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['reasonmsg' => 'Shutting down']);

            return true;
        })->andReturn($response);

    $resource->stopProcess('Shutting down');
})->doesNotPerformAssertions();

test('info', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'virtualserver_antiflood_points_needed_command_block' => '150',
            'virtualserver_antiflood_points_needed_ip_block' => '250',
            'virtualserver_antiflood_points_needed_plugin_block' => '350',
            'virtualserver_antiflood_points_tick_reduce' => '5',
            'virtualserver_channel_temp_delete_delay_default' => '0',
            'virtualserver_client_connections' => '2',
            'virtualserver_clientsonline' => '5',
            'virtualserver_codec_encryption_mode' => '0',
            'virtualserver_complain_autoban_count' => '5',
            'virtualserver_complain_autoban_time' => '1200',
            'virtualserver_complain_remove_time' => '3600',
            'virtualserver_created' => '1700000000',
            'virtualserver_default_channel_admin_group' => '5',
            'virtualserver_default_channel_group' => '8',
            'virtualserver_default_server_group' => '8',
            'virtualserver_filebase' => '/tmp/ts3',
            'virtualserver_flag_password' => '0',
            'virtualserver_hostbanner_gfx_interval' => '0',
            'virtualserver_hostbanner_gfx_url' => '',
            'virtualserver_hostbanner_mode' => '0',
            'virtualserver_hostbanner_url' => '',
            'virtualserver_hostbutton_gfx_url' => '',
            'virtualserver_hostbutton_tooltip' => '',
            'virtualserver_hostbutton_url' => '',
            'virtualserver_hostmessage' => '',
            'virtualserver_hostmessage_mode' => '0',
            'virtualserver_icon_id' => '0',
            'virtualserver_id' => '1',
            'virtualserver_log_channel' => '0',
            'virtualserver_log_client' => '1',
            'virtualserver_log_filetransfer' => '0',
            'virtualserver_log_permissions' => '1',
            'virtualserver_log_query' => '0',
            'virtualserver_log_server' => '1',
            'virtualserver_max_download_total_bandwidth' => '18446744073709551615',
            'virtualserver_max_upload_total_bandwidth' => '18446744073709551615',
            'virtualserver_maxclients' => '32',
            'virtualserver_min_android_version' => '0',
            'virtualserver_min_client_version' => '0',
            'virtualserver_min_ios_version' => '0',
            'virtualserver_name' => 'TeamSpeak Server',
            'virtualserver_name_phonetic' => '',
            'virtualserver_needed_identity_security_level' => '8',
            'virtualserver_nickname' => '',
            'virtualserver_password' => '',
            'virtualserver_platform' => 'Linux',
            'virtualserver_port' => '9987',
            'virtualserver_priority_speaker_dimm_modificator' => '-18.0000',
            'virtualserver_query_client_connections' => '1',
            'virtualserver_queryclientsonline' => '1',
            'virtualserver_reserved_slots' => '0',
            'virtualserver_status' => 'online',
            'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
            'virtualserver_uptime' => '3600',
            'virtualserver_version' => '3.13.7 [Build: 1666597175]',
            'virtualserver_weblist_enabled' => '1',
            'virtualserver_welcomemessage' => 'Welcome!',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->info()->name)->toBe('TeamSpeak Server');
});

test('connection info', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'connection_filetransfer_bandwidth_sent' => '0',
            'connection_filetransfer_bandwidth_received' => '0',
            'connection_filetransfer_bytes_sent_total' => '0',
            'connection_filetransfer_bytes_received_total' => '0',
            'connection_packets_sent_total' => '1000',
            'connection_bytes_sent_total' => '50000',
            'connection_packets_received_total' => '900',
            'connection_bytes_received_total' => '45000',
            'connection_bandwidth_sent_last_second_total' => '100',
            'connection_bandwidth_sent_last_minute_total' => '6000',
            'connection_bandwidth_received_last_second_total' => '90',
            'connection_bandwidth_received_last_minute_total' => '5400',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->connectionInfo()->packetsSentTotal)->toBe(1000);
});

test('add temp password', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['pw' => 'secret', 'desc' => 'Guest pass', 'theduration' => '3600', 'tcid' => '0', 'tcpw' => '']);

            return true;
        })->andReturn($response);

    $resource->addTempPassword('secret', 'Guest pass', 3600);
})->doesNotPerformAssertions();

test('delete temp password', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['pw' => 'secret']);

            return true;
        })->andReturn($response);

    $resource->deleteTempPassword('secret');
})->doesNotPerformAssertions();

test('list temp passwords', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'nickname' => 'Guest',
            'uid' => 'abc123==',
            'desc' => 'Guest pass',
            'pw_clear' => 'secret',
            'start' => '1700000000',
            'end' => '1700003600',
            'tcid' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client->shouldReceive('sendRequest')->once()->andReturn($response);

    expect($resource->listTempPasswords()->passwords)->toHaveCount(1);
});

test('edit', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['virtualserver_name' => 'New Name']);

            return true;
        })->andReturn($response);

    $resource->edit(['virtualserver_name' => 'New Name']);
})->doesNotPerformAssertions();

test('create snapshot', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'hash' => 'abc123',
            'virtualserver_snapshot' => 'base64encodedsnapshotdata==',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBe('');

            return true;
        })->andReturn($response);

    $result = $resource->createSnapshot();
    expect($result->hash)->toBe('abc123')
        ->and($result->data)->toBe('base64encodedsnapshotdata==');
});

test('deploy snapshot', function () {
    $resource = new Servers($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['virtualserver_snapshot' => 'base64encodedsnapshotdata==']);

            return true;
        })->andReturn($response);

    $resource->deploySnapshot('base64encodedsnapshotdata==');
})->doesNotPerformAssertions();
