<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\BindingListResponse;
use TeamSpeak\WebQuery\Responses\Servers\BindingListResponseBinding;

test('from', function () {
    $response = BindingListResponse::from([
        ['ip' => '0.0.0.0'],
        ['ip' => '::'],
    ]);

    expect($response->bindings)->toHaveCount(2)
        ->and($response->bindings[0])->toBeInstanceOf(BindingListResponseBinding::class);
});
