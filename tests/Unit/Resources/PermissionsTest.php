<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\Permissions;
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
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'permid' => '1',
            'permname' => 'b_serverinstance_help_view',
            'permdesc' => 'Retrieve information about the server instance',
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

    expect($resource->list()->permissions)->toBeArray()->toHaveCount(1);
});

test('get id by name', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'permid' => '1',
            'permsid' => 'b_serverinstance_help_view',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['permsid' => 'b_serverinstance_help_view']);

            return true;
        })->andReturn($response);

    $result = $resource->getIdByName('b_serverinstance_help_view');
    expect($result->id)->toBe(1)
        ->and($result->name)->toBe('b_serverinstance_help_view');
});

test('overview by permission ID', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            't' => '0',
            'id1' => '0',
            'id2' => '0',
            'p' => '17',
            'v' => '1',
            'n' => '0',
            's' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '2', 'permid' => '17']);

            return true;
        })->andReturn($response);

    expect($resource->overview(1, 2, 17)->permissions)->toBeArray()->toHaveCount(1);
});

test('overview by permission name', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            't' => '0',
            'id1' => '0',
            'id2' => '0',
            'p' => '17',
            'v' => '1',
            'n' => '0',
            's' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '2', 'permsid' => 'b_serverinstance_help_view']);

            return true;
        })->andReturn($response);

    expect($resource->overview(1, 2, 'b_serverinstance_help_view')->permissions)->toBeArray()->toHaveCount(1);
});

test('get by ID', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'permid' => '17835',
            'permsid' => 'b_serverinstance_help_view',
            'permvalue' => '1',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['permid' => '17835']);

            return true;
        })->andReturn($response);

    $result = $resource->get(17835);
    expect($result->id)->toBe(17835)
        ->and($result->value)->toBe(1);
});

test('get by name', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'permid' => '17835',
            'permsid' => 'b_serverinstance_help_view',
            'permvalue' => '1',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['permsid' => 'b_serverinstance_help_view']);

            return true;
        })->andReturn($response);

    $result = $resource->get('b_serverinstance_help_view');
    expect($result->name)->toBe('b_serverinstance_help_view');
});

test('find by ID', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            't' => '0',
            'id1' => '0',
            'id2' => '0',
            'p' => '17835',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['permid' => '17835']);

            return true;
        })->andReturn($response);

    expect($resource->find(17835)->assignments)->toHaveCount(1);
});

test('find by name', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            't' => '0',
            'id1' => '0',
            'id2' => '0',
            'p' => '17835',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['permsid' => 'b_serverinstance_help_view']);

            return true;
        })->andReturn($response);

    expect($resource->find('b_serverinstance_help_view')->assignments)->toHaveCount(1);
});

test('reset', function () {
    $resource = new Permissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
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

    expect($resource->reset()->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
});
