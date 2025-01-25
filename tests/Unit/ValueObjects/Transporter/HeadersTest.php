<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\Transporter\ContentType;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;

it('can be created from an API Token', function () {
    $headers = Headers::withXApiKey(ApiKey::from('foo'));

    expect($headers->toArray())->toBe([
        'X-Api-Key' => 'foo',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withXApiKey(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'X-Api-Key' => 'foo',
        'Content-Type' => 'application/json',
    ]);
});

it('can have custom header', function () {
    $headers = Headers::withXApiKey(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON)
        ->withCustomHeader('X-Foo', 'bar');

    expect($headers->toArray())->toBe([
        'X-Api-Key' => 'foo',
        'Content-Type' => 'application/json',
        'X-Foo' => 'bar',
    ]);
});
