<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Exceptions\InvalidParameter;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

it('has a post method', function () {
    $payload = new Payload(Command::Version);

    $baseUri = BaseUri::from('teamspeak.com');
    $headers = Headers::withXApiKey(ApiKey::from('foo'));

    expect($payload->toRequest($baseUri, $headers)->getMethod())->toBe('POST');
});

it('has a uri', function () {
    $payload = new Payload(Command::Version);

    $baseUri = BaseUri::from('teamspeak.com');
    $headers = Headers::withXApiKey(ApiKey::from('foo'));

    $uri = $payload->toRequest($baseUri, $headers)->getUri();

    expect($uri->getHost())->toBe('teamspeak.com')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/'.Command::Version->value);
});

it('converts arguments', function () {
    $payload = new Payload(Command::Version, [
        'foo' => 'bar',
        'check' => true,
        'array' => [1, 2, 3],
        'null' => null,
    ], [
        'enabled' => true,
        'disabled' => false,
    ]);

    $baseUri = BaseUri::from('teamspeak.com');
    $headers = Headers::withXApiKey(ApiKey::from('foo'));

    $contents = $payload->toRequest($baseUri, $headers)->getBody()->getContents();
    $arguments = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

    expect($arguments)->toBe([
        'foo' => 'bar',
        'check' => '1',
        'array' => [1, 2, 3],
        '-enabled' => '',
    ])->and($arguments)->not()->toHaveKeys([
        'null',
        'disabled',
        '-disabled',
    ]);
});

it('does not pass non scalar arguments except arrays', function () {
    $payload = new Payload(Command::Version, [
        'foo' => new stdClass(),
    ]);

    $baseUri = BaseUri::from('teamspeak.com');
    $headers = Headers::withXApiKey(ApiKey::from('foo'));

    $payload->toRequest($baseUri, $headers);
})->throws(InvalidParameter::class, 'Not scalar value for parameter "foo": object');
