<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Enums\ReasonIdentifier;
use TeamSpeak\WebQuery\Exceptions\NotFoundException;
use TeamSpeak\WebQuery\Resources\Clients;
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

test('client', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'clid' => '841',
            'client_database_id' => '10',
            'client_nickname' => 'Smith',
            'client_type' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    '-uid' => '',
                    '-away' => '',
                    '-voice' => '',
                    '-times' => '',
                    '-groups' => '',
                    '-info' => '',
                    '-country' => '',
                    '-ip' => '',
                    '-badges' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->list(true, true, true, true, true, true, true, true, true);
});

test('info', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'client_away' => '0',
            'client_away_message' => '',
            'client_badges' => '',
            'client_base64HashClientUID' => '',
            'client_channel_group_id' => '8',
            'client_channel_group_inherited_channel_id' => '1',
            'client_country' => '',
            'client_created' => '0',
            'client_database_id' => '1',
            'client_default_channel' => '',
            'client_default_token' => '',
            'client_description' => '',
            'client_flag_avatar' => '',
            'client_icon_id' => '0',
            'client_idle_time' => '39760',
            'client_input_hardware' => '0',
            'client_input_muted' => '0',
            'client_integrations' => '',
            'client_is_channel_commander' => '0',
            'client_is_priority_speaker' => '0',
            'client_is_recording' => '0',
            'client_is_talker' => '0',
            'client_lastconnected' => '0',
            'client_login_name' => '',
            'client_meta_data' => '',
            'client_month_bytes_downloaded' => '0',
            'client_month_bytes_uploaded' => '0',
            'client_myteamspeak_avatar' => '',
            'client_myteamspeak_id' => '',
            'client_needed_serverquery_view_power' => '100',
            'client_nickname' => 'serveradmin',
            'client_nickname_phonetic' => '',
            'client_output_hardware' => '0',
            'client_output_muted' => '0',
            'client_outputonly_muted' => '0',
            'client_platform' => 'ServerQuery',
            'client_security_hash' => '',
            'client_servergroups' => '2',
            'client_signed_badges' => '',
            'client_talk_power' => '0',
            'client_talk_request' => '0',
            'client_talk_request_msg' => '',
            'client_total_bytes_downloaded' => '0',
            'client_total_bytes_uploaded' => '0',
            'client_totalconnections' => '0',
            'client_type' => '1',
            'client_unique_identifier' => 'serveradmin',
            'client_version' => 'ServerQuery',
            'client_version_sign' => '',
            'connection_bandwidth_received_last_minute_total' => '0',
            'connection_bandwidth_received_last_second_total' => '0',
            'connection_bandwidth_sent_last_minute_total' => '0',
            'connection_bandwidth_sent_last_second_total' => '0',
            'connection_bytes_received_total' => '0',
            'connection_bytes_sent_total' => '0',
            'connection_client_ip' => '100.100.100.100',
            'connection_connected_time' => '0',
            'connection_filetransfer_bandwidth_received' => '0',
            'connection_filetransfer_bandwidth_sent' => '0',
            'connection_packets_received_total' => '0',
            'connection_packets_sent_total' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->info(1);
});

test('info not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->info(1);
})->throws(NotFoundException::class);

test('find', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'clid' => '841',
            'client_nickname' => 'Smith',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'pattern' => '%Smith%',
                ]);

            return true;
        })->andReturn($response);

    $resource->find('%Smith%');
});

test('edit', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_description' => 'Best guy ever!',
                    'clid' => '10',
                ]);

            return true;
        })->andReturn($response);

    $resource->edit(10, ['client_description' => 'Best guy ever!']);
});

test('edit description', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_description' => 'Best guy ever!',
                    'clid' => '10',
                ]);

            return true;
        })->andReturn($response);

    $resource->editDescription(10, 'Best guy ever!');
});

test('get IDs', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
            'clid' => '1',
            'name' => 'Janko',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
                ]);

            return true;
        })->andReturn($response);

    $resource->getIds('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});

test('get database ID from UID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
            'cldbid' => '1',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
                ]);

            return true;
        })->andReturn($response);

    $resource->getDbIdFromUid('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});

test('database ID from UID not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
                ]);

            return true;
        })->andReturn($response);

    $resource->getDbIdFromUid('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
})->throws(NotFoundException::class);

test('get name from UID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
            'cldbid' => '1',
            'name' => 'Smith',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
                ]);

            return true;
        })->andReturn($response);

    $resource->getNameFromUid('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
});

test('get name from UID not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
                ]);

            return true;
        })->andReturn($response);

    $resource->getNameFromUid('dyjxkshZP6bz0n3bnwFQ1CkwZOM=');
})->throws(NotFoundException::class);

test('get UID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
            'clid' => '1',
            'nickname' => 'Smith',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->getUid(1);
});

test('get UID not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->getUid(1);
})->throws(NotFoundException::class);

test('get name from database ID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cluid' => 'dyjxkshZP6bz0n3bnwFQ1CkwZOM=',
            'cldbid' => '1',
            'name' => 'Smith',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->getNameFromDbId(1);
});

test('get name from database ID not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->getNameFromDbId(1);
})->throws(NotFoundException::class);

test('set server query login', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'client_login_password' => '+r\/TQqvR',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_login_name' => 'Smith',
                ]);

            return true;
        })->andReturn($response);

    $resource->setServerQueryLogin('Smith');
});

test('set server query login not found', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_login_name' => 'Smith',
                ]);

            return true;
        })->andReturn($response);

    $resource->setServerQueryLogin('Smith');
})->throws(NotFoundException::class);

test('update', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_nickname' => 'ScP (query)',
                ]);

            return true;
        })->andReturn($response);

    $resource->update(['client_nickname' => 'ScP (query)']);
});

test('update nickname', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'client_nickname' => 'ScP (query)',
                ]);

            return true;
        })->andReturn($response);

    $resource->updateNickname('ScP (query)');
});

test('move single client', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                    'cid' => '2',
                    'cpw' => 'password',
                ]);

            return true;
        })->andReturn($response);

    $resource->move(1, 2, 'password');
});

test('move many clients', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => [1, 2, 3],
                    'cid' => '2',
                    'cpw' => 'password',
                ]);

            return true;
        })->andReturn($response);

    $resource->move([1, 2, 3], 2, 'password');
});

test('kick single client', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                    'reasonid' => '4',
                ]);

            return true;
        })->andReturn($response);

    $resource->kick(1, ReasonIdentifier::KickChannel);
});

test('kick many clients', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => [1, 2, 3],
                    'reasonid' => '4',
                ]);

            return true;
        })->andReturn($response);

    $resource->kick([1, 2, 3], ReasonIdentifier::KickChannel);
});

test('kick with reason', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                    'reasonid' => '5',
                    'reasonmsg' => 'Go away!',
                ]);

            return true;
        })->andReturn($response);

    $resource->kick(1, ReasonIdentifier::KickServer, 'Go away!');
});

test('kick from channel', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                    'reasonid' => '4',
                    'reasonmsg' => 'Go away!',
                ]);

            return true;
        })->andReturn($response);

    $resource->kickFromChannel(1, 'Go away!');
});

test('kick from server', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '1',
                    'reasonid' => '5',
                    'reasonmsg' => 'Go away!',
                ]);

            return true;
        })->andReturn($response);

    $resource->kickFromServer(1, 'Go away!');
});

test('poke', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'clid' => '5',
                    'msg' => 'Wake up!',
                ]);

            return true;
        })->andReturn($response);

    $resource->poke(5, 'Wake up!');
});

test('get permissions', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cldbid' => '10',
            'permsid' => 'i_client_max_clones_uid',
            'permnegated' => '0',
            'permskip' => '1',
            'permvalue' => '75',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '2',
                    '-permsid' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->getPermissions(2, true);
});

test('add permission by ID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '16',
                    'permid' => '17276',
                    'permvalue' => '50',
                    'permskip' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->addPermission(16, 17276, 50, true);
});

test('add permission by name', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '16',
                    'permsid' => 'i_client_max_clones_uid',
                    'permvalue' => '50',
                    'permskip' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->addPermission(16, 'i_client_max_clones_uid', 50, true);
});

test('delete permission by ID', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '16',
                    'permid' => '17276',
                ]);

            return true;
        })->andReturn($response);

    $resource->deletePermission(16, 17276);
});

test('delete permission by name', function () {
    $resource = new Clients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'cldbid' => '16',
                    'permsid' => 'i_client_max_clones_uid',
                ]);

            return true;
        })->andReturn($response);

    $resource->deletePermission(16, 'i_client_max_clones_uid');
});
