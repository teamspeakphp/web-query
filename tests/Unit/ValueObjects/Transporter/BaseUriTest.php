<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('teamspeak.com');

    expect($baseUri->toString())->toBe('https://teamspeak.com/');
});

it('can be created from a string with http protocol', function () {
    $baseUri = BaseUri::from('http://teamspeak.com');

    expect($baseUri->toString())->toBe('http://teamspeak.com/');
});

it('can be created from a string with https protocol', function () {
    $baseUri = BaseUri::from('https://teamspeak.com');

    expect($baseUri->toString())->toBe('https://teamspeak.com/');
});
