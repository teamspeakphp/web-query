<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Messages\ListResponseMessage;

test('from', function () {
    $response = ListResponseMessage::from([
        'msgid' => '1',
        'cluid' => 'foo',
        'subject' => 'bar',
        'timestamp' => '123456789',
        'flag_read' => '1',
    ]);

    expect($response)
        ->toBeInstanceOf(ListResponseMessage::class)
        ->id->toBe(1)
        ->senderUniqueIdentifier->toBe('foo')
        ->subject->toBe('bar')
        ->time->getTimestamp()->toBe(123456789)
        ->read->toBeTrue();
});
