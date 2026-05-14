<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Complaints\ListResponse;
use TeamSpeak\WebQuery\Responses\Complaints\ListResponseComplaint;

test('from', function () {
    $response = ListResponse::from([[
        'tcldbid' => '5',
        'tname' => 'Target',
        'fcldbid' => '3',
        'fname' => 'Reporter',
        'message' => 'bad behavior',
        'timestamp' => '1719081785',
    ]]);

    expect($response->complaints)->toBeArray()->toHaveCount(1)
        ->and($response->complaints[0])->toBeInstanceOf(ListResponseComplaint::class);
});
