<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\ChannelPermissions;
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
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'permid' => '42',
            'permnegated' => '0',
            'permskip' => '0',
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
                ->toBe(['cid' => '1']);

            return true;
        })->andReturn($response);

    expect($resource->list(1)->permissions)->toBeArray()->toHaveCount(1);
});

test('list with names', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'permsid' => 'i_channel_needed_join_power',
            'permnegated' => '0',
            'permskip' => '0',
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
                ->toBe(['cid' => '1', '-permsid' => '']);

            return true;
        })->andReturn($response);

    expect($resource->list(1, true)->permissions)->toHaveCount(1);
});

test('add by ID', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'permid' => '42', 'permvalue' => '75', 'permnegated' => '0', 'permskip' => '0']);

            return true;
        })->andReturn($response);

    $resource->add(1, 42, 75);
})->doesNotPerformAssertions();

test('add by name', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'permsid' => 'i_channel_needed_join_power', 'permvalue' => '75', 'permnegated' => '1', 'permskip' => '1']);

            return true;
        })->andReturn($response);

    $resource->add(1, 'i_channel_needed_join_power', 75, true, true);
})->doesNotPerformAssertions();

test('delete by ID', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'permid' => '42']);

            return true;
        })->andReturn($response);

    $resource->delete(1, 42);
})->doesNotPerformAssertions();

test('delete by name', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'permsid' => 'i_channel_needed_join_power']);

            return true;
        })->andReturn($response);

    $resource->delete(1, 'i_channel_needed_join_power');
})->doesNotPerformAssertions();

test('list for client', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'cldbid' => '18',
            'permid' => '42',
            'permnegated' => '0',
            'permskip' => '0',
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
                ->toBe(['cid' => '1', 'cldbid' => '18']);

            return true;
        })->andReturn($response);

    expect($resource->listForClient(1, 18)->permissions)->toBeArray()->toHaveCount(1);
});

test('list for client with names', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'cldbid' => '18',
            'permsid' => 'i_channel_needed_join_power',
            'permnegated' => '0',
            'permskip' => '0',
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
                ->toBe(['cid' => '1', 'cldbid' => '18', '-permsid' => '']);

            return true;
        })->andReturn($response);

    expect($resource->listForClient(1, 18, true)->permissions)->toHaveCount(1);
});

test('add for client by ID', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '18', 'permid' => '42', 'permvalue' => '75', 'permnegated' => '0', 'permskip' => '0']);

            return true;
        })->andReturn($response);

    $resource->addForClient(1, 18, 42, 75);
})->doesNotPerformAssertions();

test('add for client by name', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '18', 'permsid' => 'i_channel_needed_join_power', 'permvalue' => '75', 'permnegated' => '1', 'permskip' => '0']);

            return true;
        })->andReturn($response);

    $resource->addForClient(1, 18, 'i_channel_needed_join_power', 75, true);
})->doesNotPerformAssertions();

test('delete for client by ID', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '18', 'permid' => '42']);

            return true;
        })->andReturn($response);

    $resource->deleteForClient(1, 18, 42);
})->doesNotPerformAssertions();

test('delete for client by name', function () {
    $resource = new ChannelPermissions($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cid' => '1', 'cldbid' => '18', 'permsid' => 'i_channel_needed_join_power']);

            return true;
        })->andReturn($response);

    $resource->deleteForClient(1, 18, 'i_channel_needed_join_power');
})->doesNotPerformAssertions();
