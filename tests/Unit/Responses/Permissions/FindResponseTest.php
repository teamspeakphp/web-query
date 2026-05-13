<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\FindResponse;
use TeamSpeak\WebQuery\Responses\Permissions\FindResponseAssignment;

test('from', function () {
    $response = FindResponse::from([[
        't' => '0',
        'id1' => '0',
        'id2' => '0',
        'p' => '17835',
    ]]);

    expect($response->assignments)->toHaveCount(1)
        ->and($response->assignments[0])->toBeInstanceOf(FindResponseAssignment::class);
});
