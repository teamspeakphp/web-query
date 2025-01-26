<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Enums\TextMessageTargetMode;
use TeamSpeak\WebQuery\Exceptions\NotFoundException;
use TeamSpeak\WebQuery\Resources\Messages;
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

test('send', function () {
    $resource = new Messages($this->http);

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
                    'targetmode' => '1',
                    'target' => 'bar',
                    'msg' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->send(TextMessageTargetMode::Client, 'foo', 'bar');
});

test('send to client', function () {
    $resource = new Messages($this->http);

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
                    'targetmode' => '1',
                    'target' => 'bar',
                    'msg' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->sendToClient('foo', 'bar');
});

test('send to channel', function () {
    $resource = new Messages($this->http);

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
                    'targetmode' => '2',
                    'msg' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->sendToChannel('foo');
});

test('send to server', function () {
    $resource = new Messages($this->http);

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
                    'targetmode' => '3',
                    'msg' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->sendToServer('foo');
});

test('broadcast', function () {
    $resource = new Messages($this->http);

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
                    'msg' => 'foo',
                ]);

            return true;
        })->andReturn($response);

    $resource->broadcast('foo');
});

test('list inbox', function () {
    $resource = new Messages($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'msgid' => '1',
            'cluid' => 'foo',
            'subject' => 'bar',
            'timestamp' => '123456789',
            'flag_read' => '1',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect($resource->listInbox()->messages)
        ->toBeArray()
        ->toHaveCount(1);
});

test('send inbox', function () {
    $resource = new Messages($this->http);

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
                    'cluid' => 'foo',
                    'subject' => 'bar',
                    'message' => 'foobar',
                ]);

            return true;
        })->andReturn($response);

    $resource->sendInbox('foo', 'bar', 'foobar');
});

test('delete inbox', function () {
    $resource = new Messages($this->http);

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
                    'msgid' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->deleteInbox(1);
});

test('get inbox', function () {
    $resource = new Messages($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'msgid' => '1',
            'cluid' => 'foo',
            'subject' => 'bar',
            'message' => 'foobar',
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
                    'msgid' => '1',
                ]);

            return true;
        })->andReturn($response);

    expect($resource->getInbox(1))->id->toBe(1);
});

test('get inbox with database empty result set', function () {
    $resource = new Messages($this->http);

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

    $resource->getInbox(1);
})->throws(NotFoundException::class);

test('update flag inbox', function () {
    $resource = new Messages($this->http);

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
                    'msgid' => '1',
                    'flag' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->updateFlagInbox(1, true);
});

test('mark as read inbox', function () {
    $resource = new Messages($this->http);

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
                    'msgid' => '1',
                    'flag' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->markAsReadInbox(1);
});

test('mark as unread inbox', function () {
    $resource = new Messages($this->http);

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
                    'msgid' => '1',
                    'flag' => '0',
                ]);

            return true;
        })->andReturn($response);

    $resource->markAsUnreadInbox(1);
});
