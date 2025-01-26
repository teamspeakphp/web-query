<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Messages\ListResponse;
use TeamSpeak\WebQuery\Responses\Messages\ListResponseMessage;

test('from', function () {
    $response = ListResponse::from([[
        'msgid' => '1',
        'cluid' => 'foo',
        'subject' => 'bar',
        'timestamp' => '123456789',
        'flag_read' => '1',
    ]]);

    expect($response)
        ->toBeInstanceOf(ListResponse::class)
        ->messages->toBeArray()->toHaveCount(1)
        ->messages->each->toBeInstanceOf(ListResponseMessage::class);
});
