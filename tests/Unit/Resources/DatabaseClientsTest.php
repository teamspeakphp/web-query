<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Exceptions\NotFoundException;
use TeamSpeak\WebQuery\Resources\DatabaseClients;
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
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cldbid' => '2',
            'client_created' => '123456789',
            'client_description' => '',
            'client_lastconnected' => '123456789',
            'client_lastip' => '',
            'client_login_name' => '',
            'client_nickname' => 'foo',
            'client_totalconnections' => '0',
            'client_unique_identifier' => 'bar',
            'count' => '1',
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
                    'start' => '1',
                    'duration' => '1',
                    '-count' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->list(1, 1, true);
});

test('info', function () {
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'client_base64HashClientUID' => 'foobar',
            'client_created' => '123456789',
            'client_database_id' => '10',
            'client_description' => 'description',
            'client_flag_avatar' => '',
            'client_lastconnected' => '123456789',
            'client_lastip' => '100.100.100.100',
            'client_month_bytes_downloaded' => '0',
            'client_month_bytes_uploaded' => '0',
            'client_nickname' => 'bar',
            'client_total_bytes_downloaded' => '0',
            'client_total_bytes_uploaded' => '0',
            'client_totalconnections' => '0',
            'client_unique_identifier' => 'foobar',
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

    $resource->info(1);
});

test('info with database empty result set', function () {
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 1281,
            'message' => 'database empty result set',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $resource->info(1);
})->throws(NotFoundException::class);

test('find', function () {
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
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
                    'pattern' => '%foo%',
                    '-uid' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->find('%foo%', true);
});

test('find by name', function () {
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
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
                    'pattern' => '%foo%',
                ]);

            return true;
        })->andReturn($response);

    $resource->findByName('%foo%');
});

test('find by uid', function () {
    $resource = new DatabaseClients($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
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
                    'pattern' => '%foo%',
                    '-uid' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->findByUid('%foo%');
});

test('edit', function () {
    $resource = new DatabaseClients($this->http);

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
                    'cldbid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->edit(1, []);
});

test('edit description', function () {
    $resource = new DatabaseClients($this->http);

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
                    'client_description' => 'foo',
                    'cldbid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->editDescription(1, 'foo');
});

test('delete', function () {
    $resource = new DatabaseClients($this->http);

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
                    'cldbid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->delete(1);
});
