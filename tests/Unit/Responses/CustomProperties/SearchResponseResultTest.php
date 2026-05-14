<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\CustomProperties\SearchResponseResult;

test('from', function () {
    $result = SearchResponseResult::from([
        'cldbid' => '18',
        'ident' => 'forum_id',
        'value' => '12345',
    ]);

    expect($result->clientDatabaseId)->toBe(18)
        ->and($result->ident)->toBe('forum_id')
        ->and($result->value)->toBe('12345');
});
