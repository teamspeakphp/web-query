<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\CustomProperties\InfoResponse;
use TeamSpeak\WebQuery\Responses\CustomProperties\InfoResponseProperty;

test('from', function () {
    $response = InfoResponse::from([[
        'cldbid' => '18',
        'ident' => 'forum_id',
        'value' => '12345',
    ]]);

    expect($response->properties)->toHaveCount(1)
        ->and($response->properties[0])->toBeInstanceOf(InfoResponseProperty::class);
});
