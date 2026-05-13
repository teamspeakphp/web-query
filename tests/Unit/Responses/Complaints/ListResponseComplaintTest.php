<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Complaints\ListResponseComplaint;

test('from', function () {
    $complaint = ListResponseComplaint::from([
        'tcldbid' => '5',
        'tclname' => 'Target',
        'fcldbid' => '3',
        'fclname' => 'Reporter',
        'message' => 'bad behavior',
        'timestamp' => '1719081785',
    ]);

    expect($complaint->targetClientDatabaseId)->toBe(5)
        ->and($complaint->targetClientName)->toBe('Target')
        ->and($complaint->fromClientDatabaseId)->toBe(3)
        ->and($complaint->fromClientName)->toBe('Reporter')
        ->and($complaint->message)->toBe('bad behavior')
        ->and($complaint->timestamp)->toBeInstanceOf(DateTimeImmutable::class);
});
