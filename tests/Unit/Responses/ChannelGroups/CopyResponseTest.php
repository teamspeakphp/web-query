<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\CopyResponse;

test('from with new group', function () {
    $response = CopyResponse::from([['cgid' => '6']]);

    expect($response->id)->toBe(6);
});

test('from with overwrite', function () {
    $response = CopyResponse::from([]);

    expect($response->id)->toBeNull();
});
