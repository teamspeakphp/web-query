<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\OverviewResponsePermission;

test('from', function () {
    $permission = OverviewResponsePermission::from([
        't' => '1',
        'id1' => '5',
        'id2' => '3',
        'p' => '17',
        'v' => '75',
        'n' => '1',
        's' => '0',
    ]);

    expect($permission->type)->toBe(1)
        ->and($permission->id1)->toBe(5)
        ->and($permission->id2)->toBe(3)
        ->and($permission->permId)->toBe(17)
        ->and($permission->value)->toBe(75)
        ->and($permission->negated)->toBeTrue()
        ->and($permission->skip)->toBeFalse();
});
