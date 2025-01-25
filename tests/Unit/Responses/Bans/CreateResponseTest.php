<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Bans\CreateResponse;
use TeamSpeak\WebQuery\Responses\Bans\CreateResponseBan;

test('from', function () {
    $response = CreateResponse::from([
        ['banid' => '1'],
        ['banid' => '2'],
    ]);

    expect($response)
        ->toBeInstanceOf(CreateResponse::class)
        ->bans->toBeArray()->toHaveCount(2)
        ->bans->each->toBeInstanceOf(CreateResponseBan::class);
});
