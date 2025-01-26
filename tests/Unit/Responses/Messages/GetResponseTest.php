<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Messages\GetResponse;

test('from', function () {
    $response = GetResponse::from([[
        'msgid' => '1',
        'cluid' => 'foo',
        'subject' => 'bar',
        'message' => 'foobar',
    ]]);

    expect($response)
        ->toBeInstanceOf(GetResponse::class)
        ->id->toBe(1)
        ->senderUniqueIdentifier->toBe('foo')
        ->subject->toBe('bar')
        ->message->toBe('foobar');
});
