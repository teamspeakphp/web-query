<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Channels\CreateResponse;

test('from', function () {
    $response = CreateResponse::from([[
        'cid' => '1',
    ]]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe(1);
});
