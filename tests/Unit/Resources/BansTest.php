<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\Bans;
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
    $resource = new Bans($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [
            ['banid' => '1'],
            ['banid' => '2'],
        ],
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
                    'time' => '100',
                    'banreason' => 'foobar',
                ]);

            return true;
        })->andReturn($response);

    $resource->client(1, 100, 'foobar');
});

test('list', function () {
    $resource = new Bans($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'banid' => '1',
            'created' => '1719081785',
            'duration' => '0',
            'enforcements' => '0',
            'invokercldbid' => '3',
            'invokername' => 'foo',
            'invokeruid' => 'bar',
            'ip' => '',
            'lastnickname' => 'foobar',
            'mytsid' => '',
            'name' => '',
            'reason' => '',
            'uid' => 'test',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $bans = $resource->list()->bans;

    expect($bans)->toBeArray()->toHaveCount(1);
});

test('add', function () {
    $resource = new Bans($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [
            ['banid' => '1'],
        ],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe([
                    'ip' => '100.100.100.100',
                    'name' => 'foo',
                    'uid' => 'bar',
                    'time' => '100',
                    'banreason' => 'test',
                ]);

            return true;
        })->andReturn($response);

    $resource->add('100.100.100.100', 'foo', 'bar', 100, 'test');
});

test('delete', function () {
    $resource = new Bans($this->http);

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
                    'banid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->delete(1);
});

test('delete all', function () {
    $resource = new Bans($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $resource->deleteAll();
})->doesNotPerformAssertions();
