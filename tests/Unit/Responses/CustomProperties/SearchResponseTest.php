<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\CustomProperties\SearchResponse;
use TeamSpeak\WebQuery\Responses\CustomProperties\SearchResponseResult;

test('from', function () {
    $response = SearchResponse::from([[
        'cldbid' => '18',
        'ident' => 'forum_id',
        'value' => '12345',
    ]]);

    expect($response->results)->toHaveCount(1)
        ->and($response->results[0])->toBeInstanceOf(SearchResponseResult::class);
});
