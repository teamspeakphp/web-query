<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\ChannelGroups\AddResponse;

test('from', function () {
    $response = AddResponse::from([['cgid' => '5']]);

    expect($response->id)->toBe(5);
});
