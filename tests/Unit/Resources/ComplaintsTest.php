<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\Complaints;
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
    $resource = new Complaints($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'tcldbid' => '5',
            'tclname' => 'Target',
            'fcldbid' => '3',
            'fclname' => 'Reporter',
            'message' => 'bad behavior',
            'timestamp' => '1719081785',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect($resource->list()->complaints)->toBeArray()->toHaveCount(1);
});

test('list filtered by target client', function () {
    $resource = new Complaints($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'tcldbid' => '5',
            'tclname' => 'Target',
            'fcldbid' => '3',
            'fclname' => 'Reporter',
            'message' => 'bad behavior',
            'timestamp' => '1719081785',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['tcldbid' => '5']);

            return true;
        })->andReturn($response);

    $resource->list(5);
});

test('add', function () {
    $resource = new Complaints($this->http);

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
                    'tcldbid' => '5',
                    'message' => 'bad behavior',
                ]);

            return true;
        })->andReturn($response);

    $resource->add(5, 'bad behavior');
})->doesNotPerformAssertions();

test('delete all', function () {
    $resource = new Complaints($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['tcldbid' => '5']);

            return true;
        })->andReturn($response);

    $resource->deleteAll(5);
})->doesNotPerformAssertions();

test('delete', function () {
    $resource = new Complaints($this->http);

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
                    'tcldbid' => '5',
                    'fcldbid' => '3',
                ]);

            return true;
        })->andReturn($response);

    $resource->delete(5, 3);
})->doesNotPerformAssertions();
