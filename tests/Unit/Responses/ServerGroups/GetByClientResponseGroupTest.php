<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ServerGroups\GetByClientResponseGroup;

test('from', function () {
    $response = GetByClientResponseGroup::from([
        'name' => 'Server Admin',
        'sgid' => '6',
        'cldbid' => '18',
    ]);

    expect($response)
        ->toBeInstanceOf(GetByClientResponseGroup::class)
        ->name->toBe('Server Admin')
        ->id->toBe(6)
        ->clientDatabaseId->toBe(18);
});
