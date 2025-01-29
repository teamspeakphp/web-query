<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\AddResponse;

test('from', function () {
    $response = AddResponse::from([[
        'sgid' => '13',
    ]]);

    expect($response)
        ->toBeInstanceOf(AddResponse::class)
        ->id->toBe(13);
});
