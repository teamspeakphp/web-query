<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Permissions\ListResponsePermission;

test('from', function () {
    $permission = ListResponsePermission::from([
        'permid' => '1',
        'permname' => 'b_serverinstance_help_view',
        'permdesc' => 'Retrieve information about the server instance',
        'permtype' => '0',
        'permisflag' => '1',
    ]);

    expect($permission->id)->toBe(1)
        ->and($permission->name)->toBe('b_serverinstance_help_view')
        ->and($permission->description)->toBe('Retrieve information about the server instance')
        ->and($permission->type)->toBe(0)
        ->and($permission->isFlag)->toBeTrue();
});
