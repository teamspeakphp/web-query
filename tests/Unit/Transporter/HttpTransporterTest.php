<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Exceptions\ErrorException;
use TeamSpeak\WebQuery\Exceptions\InvalidResponse;
use TeamSpeak\WebQuery\Exceptions\UnserializableResponse;
use TeamSpeak\WebQuery\Transporters\HttpTransporter;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = ApiKey::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('teamspeak.com'),
        Headers::withXApiKey($apiKey),
    );
});

test('request object', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 0,
            'message' => 'ok',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('POST')
                ->and($request->getUri())
                ->getHost()->toBe('teamspeak.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/version');

            return true;
        })->andReturn($response);

    $this->http->request($payload);
});

test('request object response', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [
            [
                'text' => 'Hey!',
                'index' => '0',
            ],
        ],
        'status' => [
            'code' => 0,
            'message' => 'ok',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->request($payload);

    expect($response->body())->toBe([
        [
            'text' => 'Hey!',
            'index' => '0',
        ],
    ]);
});

test('request object server user errors', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(401, ['Content-Type' => 'application/json'], json_encode([
        'status' => [
            'code' => 5122,
            'message' => 'invalid apikey',
            'extra_message' => 'invalid api key',
        ],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->request($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('invalid apikey: invalid api key')
                ->and($e->getErrorMessage())->toBe('invalid apikey: invalid api key')
                ->and($e->getErrorCode())->toBe(5122)
                ->and($e->getStatusCode())->toBe(401);
        });
});

test('request object server without status', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(401, ['Content-Type' => 'application/json'], json_encode([
        'foobar',
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(InvalidResponse::class, 'Invalid response: missing status key.');

test('request object server empty result', function () {
    $payload = new Payload(Command::Version);

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

    $response = $this->http->request($payload);

    expect($response->body())->toBe([]);
});

test('request object serialization errors', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(200, ['Content-Type' => 'application/json'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, 'Syntax error', 0);

test('request object non json response', function () {
    $payload = new Payload(Command::Version);

    $response = new Response(200, ['Content-Type' => 'application/xml; charset=utf-8'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->request($payload);
})->throws(UnserializableResponse::class, 'Syntax error', 0);
