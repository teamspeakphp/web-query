<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Request as Psr7Request;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Resources\PrivilegeKeys;
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
    $resource = new PrivilegeKeys($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=',
            'token_type' => '0',
            'token_id1' => '6',
            'token_id2' => '0',
            'token_description' => 'Admin key',
            'token_created' => '1700000000',
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

    expect($resource->list()->keys)->toBeArray()->toHaveCount(1);
});

test('add server group key', function () {
    $resource = new PrivilegeKeys($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['tokentype' => '0', 'tokenid1' => '6', 'tokenid2' => '0']);

            return true;
        })->andReturn($response);

    expect($resource->add(0, 6)->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
});

test('add channel group key', function () {
    $resource = new PrivilegeKeys($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [['token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=']],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['tokentype' => '1', 'tokenid1' => '5', 'tokenid2' => '3', 'tokendescription' => 'VIP channel', 'tokencustomset' => 'custom']);

            return true;
        })->andReturn($response);

    expect($resource->add(1, 5, 3, 'VIP channel', 'custom')->token)->toBe('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
});

test('delete', function () {
    $resource = new PrivilegeKeys($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=']);

            return true;
        })->andReturn($response);

    $resource->delete('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
})->doesNotPerformAssertions();

test('redeem', function () {
    $resource = new PrivilegeKeys($this->http);

    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getBody()->getContents())->toBeJson()
                ->json()
                ->toBe(['token' => 'eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=']);

            return true;
        })->andReturn($response);

    $resource->redeem('eKnFZQ9EK7G7EmPvt1Ch7vsXi5Uq+1Us7xrQKBVsMxM=');
})->doesNotPerformAssertions();
