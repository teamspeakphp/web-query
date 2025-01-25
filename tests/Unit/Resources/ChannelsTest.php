<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\Channels;
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

test('list', function () {
    $resource = new Channels($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'channel_name' => 'foo',
            'channel_needed_subscribe_power' => '75',
            'channel_order' => '0',
            'cid' => '5',
            'pid' => '0',
            'total_clients' => '0',
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
                    '-topic' => '',
                    '-flags' => '',
                    '-voice' => '',
                    '-limits' => '',
                    '-icon' => '',
                    '-secondsempty' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->list(true, true, true, true, true, true);
});

test('info', function () {
    $resource = new Channels($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'channel_banner_gfx_url' => '',
            'channel_banner_mode' => '0',
            'channel_codec' => '4',
            'channel_codec_is_unencrypted' => '1',
            'channel_codec_latency_factor' => '1',
            'channel_codec_quality' => '0',
            'channel_delete_delay' => '0',
            'channel_description' => '',
            'channel_filepath' => 'files',
            'channel_flag_default' => '0',
            'channel_flag_maxclients_unlimited' => '1',
            'channel_flag_maxfamilyclients_inherited' => '1',
            'channel_flag_maxfamilyclients_unlimited' => '1',
            'channel_flag_password' => '0',
            'channel_flag_permanent' => '1',
            'channel_flag_semi_permanent' => '0',
            'channel_forced_silence' => '0',
            'channel_icon_id' => '0',
            'channel_maxclients' => '-1',
            'channel_maxfamilyclients' => '-1',
            'channel_name' => 'foo',
            'channel_name_phonetic' => '',
            'channel_needed_talk_power' => '75',
            'channel_order' => '1',
            'channel_password' => '',
            'channel_security_salt' => '',
            'channel_topic' => '',
            'channel_unique_identifier' => 'bar',
            'pid' => '0',
            'seconds_empty' => '688423',
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
                    'cid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->info(1);
});

test('find', function () {
    $resource = new Channels($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'channel_name' => 'foo',
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
                    'pattern' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->find('foo');
});

test('move', function () {
    $resource = new Channels($this->http);

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
                    'cid' => '1',
                    'cpid' => '2',
                    'order' => '3',
                ]);

            return true;
        })->andReturn($response);

    $resource->move(1, 2, 3);
});

test('create', function () {
    $resource = new Channels($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
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
                    'channel_name' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->create('foo', []);
});

test('delete', function () {
    $resource = new Channels($this->http);

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
                    'cid' => '1',
                    'force' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->delete(1, true);
});

test('edit', function () {
    $resource = new Channels($this->http);

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
                    'cid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->edit(1, []);
});
