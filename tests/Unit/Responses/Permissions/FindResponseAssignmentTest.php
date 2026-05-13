<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\FindResponseAssignment;

test('from', function () {
    $assignment = FindResponseAssignment::from([
        't' => '2',
        'id1' => '6',
        'id2' => '3',
        'p' => '17835',
    ]);

    expect($assignment->type)->toBe(2)
        ->and($assignment->id1)->toBe(6)
        ->and($assignment->id2)->toBe(3)
        ->and($assignment->permId)->toBe(17835);
});
