<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\HostInfoResponse;

test('from', function () {
    $response = HostInfoResponse::from([[
        'instance_uptime' => '86400',
        'host_timestamp_utc' => '1700000000',
        'virtualservers_running_total' => '1',
        'virtualservers_total_maxclients' => '32',
        'virtualservers_total_clients_online' => '5',
        'virtualservers_total_channels_online' => '3',
        'connection_filetransfer_bandwidth_sent' => '0',
        'connection_filetransfer_bandwidth_received' => '0',
        'connection_filetransfer_bytes_sent_total' => '0',
        'connection_filetransfer_bytes_received_total' => '0',
        'connection_packets_sent_total' => '1000',
        'connection_bytes_sent_total' => '50000',
        'connection_packets_received_total' => '900',
        'connection_bytes_received_total' => '45000',
        'connection_bandwidth_sent_last_second_total' => '100',
        'connection_bandwidth_sent_last_minute_total' => '6000',
        'connection_bandwidth_received_last_second_total' => '90',
        'connection_bandwidth_received_last_minute_total' => '5400',
    ]]);

    expect($response->uptime)->toBe(86400)
        ->and($response->virtualServersRunning)->toBe(1)
        ->and($response->virtualServersTotalClientsOnline)->toBe(5)
        ->and($response->packetsSentTotal)->toBe(1000);
});
