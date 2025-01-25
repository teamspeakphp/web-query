<?php

declare(strict_types=1);

use GuzzleHttp\Client as GuzzleClient;
use TeamSpeak\WebQuery\Client;
use TeamSpeak\WebQuery\Exceptions\InvalidConfiguration;

it('may create a client', function () {
    $teamspeak = TeamSpeak::client('foo', 'bar', 1);

    expect($teamspeak)->toBeInstanceOf(Client::class);
});

it('may create a client with port', function () {
    $teamspeak = TeamSpeak::factory()
        ->withBaseUri('foo')
        ->withPort(1000)
        ->make();

    expect($teamspeak)->toBeInstanceOf(Client::class);
});

it('sets a custom client via factory', function () {
    $teamspeak = TeamSpeak::factory()
        ->withBaseUri('foo')
        ->withVirtualServer(1)
        ->withHttpClient(new GuzzleClient)
        ->make();

    expect($teamspeak)->toBeInstanceOf(Client::class);
});

it('sets a custom header via factory', function () {
    $teamspeak = TeamSpeak::factory()
        ->withBaseUri('foo')
        ->withVirtualServer(1)
        ->withHttpHeader('X-My-Header', 'foo')
        ->make();

    expect($teamspeak)->toBeInstanceOf(Client::class);
});

it('cannot create a client without base uri', function () {
    TeamSpeak::factory()->make();
})->throws(InvalidConfiguration::class, 'Base URI is not set.');

it('cannot create a client without virtual server and port', function () {
    TeamSpeak::factory()
        ->withBaseUri('foo')
        ->make();
})->throws(InvalidConfiguration::class, 'Either virtual server or port must be set.');
