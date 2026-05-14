<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Enums\LogLevel;
use TeamSpeak\WebQuery\Resources\Logs;
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
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'l' => '2024-06-22 20:03:05.123456|INFO    |VirtualServer |1  |client connected',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect($resource->list()->logs)->toBeArray()->toHaveCount(1);
});

test('list with options', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'l' => '2024-06-22 20:03:05.123456|INFO    |VirtualServer |1  |client connected',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['lines' => '50', 'reverse' => '1', 'instance' => '1', 'begin_pos' => '100']);

            return true;
        })->andReturn($response);

    $resource->list(lines: 50, reverse: true, instance: true, beginPos: 100);
});

test('list with default parameters sends empty body', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBe('');

            return true;
        })->andReturn($response);

    $resource->list();
});

test('add', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['loglevel' => '4', 'logmsg' => 'test message']);

            return true;
        })->andReturn($response);

    $resource->add(LogLevel::Info, 'test message');
})->doesNotPerformAssertions();

test('error shortcut', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['loglevel' => '1', 'logmsg' => 'something failed']);

            return true;
        })->andReturn($response);

    $resource->error('something failed');
})->doesNotPerformAssertions();

test('warning shortcut', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['loglevel' => '2', 'logmsg' => 'something suspicious']);

            return true;
        })->andReturn($response);

    $resource->warning('something suspicious');
})->doesNotPerformAssertions();

test('debug shortcut', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['loglevel' => '3', 'logmsg' => 'debug info']);

            return true;
        })->andReturn($response);

    $resource->debug('debug info');
})->doesNotPerformAssertions();

test('info shortcut', function () {
    $resource = new Logs($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['loglevel' => '4', 'logmsg' => 'server started']);

            return true;
        })->andReturn($response);

    $resource->info('server started');
})->doesNotPerformAssertions();
