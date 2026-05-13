<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\InstanceInfoResponse;

test('from', function () {
    $response = InstanceInfoResponse::from([[
        'serverinstance_database_version' => '27',
        'serverinstance_filetransfer_port' => '30033',
        'serverinstance_max_download_total_bandwidth' => '18446744073709551615',
        'serverinstance_max_upload_total_bandwidth' => '18446744073709551615',
        'serverinstance_guest_serverquery_group' => '1',
        'serverinstance_serverquery_flood_commands' => '50',
        'serverinstance_serverquery_flood_time' => '3',
        'serverinstance_serverquery_ban_time' => '600',
        'serverinstance_template_serveradmin_group' => '3',
        'serverinstance_template_serverdefault_group' => '8',
        'serverinstance_template_channeladmin_group' => '5',
        'serverinstance_template_channeldefault_group' => '4',
        'serverinstance_permissions_version' => '19',
        'serverinstance_pending_connections_per_ip' => '0',
    ]]);

    expect($response->databaseVersion)->toBe(27)
        ->and($response->fileTransferPort)->toBe(30033)
        ->and($response->serverQueryFloodCommands)->toBe(50)
        ->and($response->serverQueryBanTime)->toBe(600);
});
