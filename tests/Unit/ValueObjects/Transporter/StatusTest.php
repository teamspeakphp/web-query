<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\ValueObjects\Transporter\Status;

it('can be created', function () {
    $status = Status::from([
        'code' => 0,
        'message' => 'ok',
    ]);

    expect($status->code())->toBe(0)
        ->and($status->message())->toBe('ok')
        ->and($status->extraMessage())->toBeNull();
});
