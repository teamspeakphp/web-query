<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\ChannelGroups;
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
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'iconid' => '0',
            'n_member_addp' => '50',
            'n_member_removep' => '50',
            'n_modifyp' => '50',
            'name' => 'Channel Admin',
            'namemode' => '0',
            'savedb' => '1',
            'cgid' => '5',
            'sortid' => '0',
            'type' => '1',
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
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['cgid' => '5']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['name' => 'Channel Admin']);

            return true;
        })->andReturn($response);

    expect($resource->add('Channel Admin')->id)->toBe(5);
});

test('delete', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'force' => '1']);

            return true;
        })->andReturn($response);

    $resource->delete(5, true);
})->doesNotPerformAssertions();

test('copy clone', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['cgid' => '6']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['scgid' => '5', 'tcgid' => '0', 'name' => 'Channel Admin Copy', 'type' => '1']);

            return true;
        })->andReturn($response);

    expect($resource->copy(5, null, 'Channel Admin Copy')->id)->toBe(6);
});

test('copy overwrite', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['scgid' => '5', 'tcgid' => '6', 'name' => ' ', 'type' => '1']);

            return true;
        })->andReturn($response);

    expect($resource->copy(5, 6)->id)->toBeNull();
});

test('rename', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'name' => 'New Name']);

            return true;
        })->andReturn($response);

    $resource->rename(5, 'New Name');
})->doesNotPerformAssertions();

test('get permissions', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cgid' => '5',
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
                ->toBe(['cgid' => '5', '-permsid' => '']);

            return true;
        })->andReturn($response);

    expect($resource->getPermissions(5, true)->permissions)->toHaveCount(1);
});

test('add permission by ID', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'permid' => '10', 'permvalue' => '75', 'permskip' => '1']);

            return true;
        })->andReturn($response);

    $resource->addPermission(5, 10, 75, true);
})->doesNotPerformAssertions();

test('add permission by name', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'permsid' => 'i_channel_needed_join_power', 'permvalue' => '75', 'permskip' => '0']);

            return true;
        })->andReturn($response);

    $resource->addPermission(5, 'i_channel_needed_join_power', 75);
})->doesNotPerformAssertions();

test('delete permission by ID', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'permid' => '10']);

            return true;
        })->andReturn($response);

    $resource->deletePermission(5, 10);
})->doesNotPerformAssertions();

test('delete permission by name', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'permsid' => 'i_channel_needed_join_power']);

            return true;
        })->andReturn($response);

    $resource->deletePermission(5, 'i_channel_needed_join_power');
})->doesNotPerformAssertions();

test('get clients', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'cid' => '1',
            'cldbid' => '18',
            'cgid' => '5',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'cid' => '1', 'cldbid' => '18']);

            return true;
        })->andReturn($response);

    expect($resource->getClients(5, 1, 18)->clients)->toHaveCount(1);
});

test('set client channel group', function () {
    $resource = new ChannelGroups($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['cgid' => '5', 'cid' => '1', 'cldbid' => '18']);

            return true;
        })->andReturn($response);

    $resource->setClientChannelGroup(5, 1, 18);
})->doesNotPerformAssertions();
