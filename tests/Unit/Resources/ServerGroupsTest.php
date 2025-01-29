<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\ServerGroups;
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
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'iconid' => '300',
            'n_member_addp' => '75',
            'n_member_removep' => '75',
            'n_modifyp' => '75',
            'name' => 'Server Admin',
            'namemode' => '0',
            'savedb' => '1',
            'sgid' => '3',
            'sortid' => '0',
            'type' => '0',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect($resource->list()->groups)->toBeArray()->toHaveCount(1);
});

test('add', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '13',
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
                    'name' => 'Server Admin',
                ]);

            return true;
        })->andReturn($response);

    $resource->add('Server Admin');
});

test('add template', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '13',
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
                    'name' => 'Server Admin',
                    'type' => '0',
                ]);

            return true;
        })->andReturn($response);

    $resource->addTemplate('Server Admin');
});

test('add regular', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '13',
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
                    'name' => 'Server Admin',
                    'type' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->addRegular('Server Admin');
});

test('add query', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '13',
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
                    'name' => 'Server Admin',
                    'type' => '2',
                ]);

            return true;
        })->andReturn($response);

    $resource->addQuery('Server Admin');
});

test('delete', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '1',
                    'force' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->delete(1, true);
});

test('copy', function () {
    $resource = new ServerGroups($this->http);

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
                    'ssgid' => '1',
                    'tsgid' => '2',
                    'name' => ' ',
                    'type' => '1',
                ]);

            return true;
        })->andReturn($response);

    $result = $resource->copy(1, 2);

    expect($result->id)->toBeNull();
});

test('clone', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '3',
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
                    'ssgid' => '1',
                    'tsgid' => '0',
                    'name' => 'Server Admin',
                    'type' => '1',
                ]);

            return true;
        })->andReturn($response);

    $result = $resource->clone(1, 'Server Admin');

    expect($result->id)->toBe(3);
});

test('overwrite', function () {
    $resource = new ServerGroups($this->http);

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
                    'ssgid' => '1',
                    'tsgid' => '2',
                    'name' => ' ',
                    'type' => '1',
                ]);

            return true;
        })->andReturn($response);

    $result = $resource->overwrite(1, 2);

    expect($result->id)->toBeNull();
});

test('rename', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '1',
                    'name' => 'Server Admin',
                ]);

            return true;
        })->andReturn($response);

    $resource->rename(1, 'Server Admin');
});

test('get permissions', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'sgid' => '10',
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
                    'sgid' => '10',
                    '-permsid' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->getPermissions(10, true);
});

test('add permission with ID', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'permid' => '10',
                    'permvalue' => '75',
                    'permskip' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->addPermission(10, 10, 75, true);
});

test('add permission with name', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'permsid' => 'i_client_max_clones_uid',
                    'permvalue' => '75',
                    'permskip' => '1',
                ]);

            return true;
        })->andReturn($response);

    $resource->addPermission(10, 'i_client_max_clones_uid', 75, true);
});

test('delete permission by ID', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'permid' => '10',
                ]);

            return true;
        })->andReturn($response);

    $resource->deletePermission(10, 10);
});

test('delete permission by name', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'permsid' => 'i_client_max_clones_uid',
                ]);

            return true;
        })->andReturn($response);

    $resource->deletePermission(10, 'i_client_max_clones_uid');
});

test('add client', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'cldbid' => '10',
                ]);

            return true;
        })->andReturn($response);

    $resource->addClient(10, 10);
});

test('delete client', function () {
    $resource = new ServerGroups($this->http);

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
                    'sgid' => '10',
                    'cldbid' => '10',
                ]);

            return true;
        })->andReturn($response);

    $resource->deleteClient(10, 10);
});

test('get clients', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cldbid' => '18',
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
                    'sgid' => '10',
                    '-names' => '',
                ]);

            return true;
        })->andReturn($response);

    $resource->getClients(10, true);
});

test('get by client', function () {
    $resource = new ServerGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'name' => 'Server Admin',
            'sgid' => '6',
            'cldbid' => '18',
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
                    'cldbid' => '18',
                ]);

            return true;
        })->andReturn($response);

    $resource->getByClient(18);
});
