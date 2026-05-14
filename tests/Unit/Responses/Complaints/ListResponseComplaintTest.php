<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Complaints\ListResponseComplaint;

test('from', function () {
    $complaint = ListResponseComplaint::from([
        'tcldbid' => '1428',
        'tname' => 'Molly',
        'fcldbid' => '10',
        'fname' => '[MILF] Smith',
        'message' => '22',
        'timestamp' => '1778758215',
    ]);

    expect($complaint->targetClientDatabaseId)->toBe(1428)
        ->and($complaint->targetClientName)->toBe('Molly')
        ->and($complaint->fromClientDatabaseId)->toBe(10)
        ->and($complaint->fromClientName)->toBe('[MILF] Smith')
        ->and($complaint->message)->toBe('22')
        ->and($complaint->timestamp)->toBeInstanceOf(DateTimeImmutable::class)
        ->and($complaint->timestamp->getTimezone()->getName())->toBe('UTC');
});
