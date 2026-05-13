<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Responses\Servers\ConnectionInfoResponse;

test('from', function () {
    $response = ConnectionInfoResponse::from([[
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

    expect($response->packetsSentTotal)->toBe(1000)
        ->and($response->bytesReceivedTotal)->toBe(45000)
        ->and($response->bandwidthSentLastMinute)->toBe(6000);
});
