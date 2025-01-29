<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\CopyResponse;

test('from', function () {
    $response = CopyResponse::from([[
        'sgid' => '13',
    ]]);

    expect($response)
        ->toBeInstanceOf(CopyResponse::class)
        ->id->toBe(13);
});
