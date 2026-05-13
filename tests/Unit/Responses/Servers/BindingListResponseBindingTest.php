<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\BindingListResponseBinding;

test('from', function () {
    $binding = BindingListResponseBinding::from(['ip' => '0.0.0.0']);

    expect($binding->ip)->toBe('0.0.0.0');
});
