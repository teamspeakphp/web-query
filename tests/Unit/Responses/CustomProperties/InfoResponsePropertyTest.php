<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\CustomProperties\InfoResponseProperty;

test('from', function () {
    $property = InfoResponseProperty::from([
        'cldbid' => '18',
        'ident' => 'forum_id',
        'value' => '12345',
    ]);

    expect($property->clientDatabaseId)->toBe(18)
        ->and($property->ident)->toBe('forum_id')
        ->and($property->value)->toBe('12345');
});
