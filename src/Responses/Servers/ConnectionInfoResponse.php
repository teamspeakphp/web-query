<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class ConnectionInfoResponse
{
    private function __construct(
        public int $fileTransferBandwidthSent,
        public int $fileTransferBandwidthReceived,
        public int $fileTransferBytesSentTotal,
        public int $fileTransferBytesReceivedTotal,
        public int $packetsSentTotal,
        public int $bytesSentTotal,
        public int $packetsReceivedTotal,
        public int $bytesReceivedTotal,
        public int $bandwidthSentLastSecond,
        public int $bandwidthSentLastMinute,
        public int $bandwidthReceivedLastSecond,
        public int $bandwidthReceivedLastMinute,
    ) {}

    /**
     * @param  array{0: array{connection_filetransfer_bandwidth_sent: string, connection_filetransfer_bandwidth_received: string, connection_filetransfer_bytes_sent_total: string, connection_filetransfer_bytes_received_total: string, connection_packets_sent_total: string, connection_bytes_sent_total: string, connection_packets_received_total: string, connection_bytes_received_total: string, connection_bandwidth_sent_last_second_total: string, connection_bandwidth_sent_last_minute_total: string, connection_bandwidth_received_last_second_total: string, connection_bandwidth_received_last_minute_total: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['connection_filetransfer_bandwidth_sent'],
            (int) $attributes[0]['connection_filetransfer_bandwidth_received'],
            (int) $attributes[0]['connection_filetransfer_bytes_sent_total'],
            (int) $attributes[0]['connection_filetransfer_bytes_received_total'],
            (int) $attributes[0]['connection_packets_sent_total'],
            (int) $attributes[0]['connection_bytes_sent_total'],
            (int) $attributes[0]['connection_packets_received_total'],
            (int) $attributes[0]['connection_bytes_received_total'],
            (int) $attributes[0]['connection_bandwidth_sent_last_second_total'],
            (int) $attributes[0]['connection_bandwidth_sent_last_minute_total'],
            (int) $attributes[0]['connection_bandwidth_received_last_second_total'],
            (int) $attributes[0]['connection_bandwidth_received_last_minute_total'],
        );
    }
}
