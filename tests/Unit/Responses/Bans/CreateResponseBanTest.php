<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Bans\CreateResponseBan;

test('from', function () {
    $response = CreateResponseBan::from([
        'banid' => '1',
    ]);

    expect($response)
        ->toBeInstanceOf(CreateResponseBan::class)
        ->id->toBe(1);
});
