<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class HostInfoResponse
{
    private function __construct(
        public int $uptime,
        public int $timestampUtc,
        public int $virtualServersRunning,
        public int $virtualServersTotalMaxClients,
        public int $virtualServersTotalClientsOnline,
        public int $virtualServersTotalChannelsOnline,
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
     * @param  array{0: array{instance_uptime: string, host_timestamp_utc: string, virtualservers_running_total: string, virtualservers_total_maxclients: string, virtualservers_total_clients_online: string, virtualservers_total_channels_online: string, connection_filetransfer_bandwidth_sent: string, connection_filetransfer_bandwidth_received: string, connection_filetransfer_bytes_sent_total: string, connection_filetransfer_bytes_received_total: string, connection_packets_sent_total: string, connection_bytes_sent_total: string, connection_packets_received_total: string, connection_bytes_received_total: string, connection_bandwidth_sent_last_second_total: string, connection_bandwidth_sent_last_minute_total: string, connection_bandwidth_received_last_second_total: string, connection_bandwidth_received_last_minute_total: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['instance_uptime'],
            (int) $attributes[0]['host_timestamp_utc'],
            (int) $attributes[0]['virtualservers_running_total'],
            (int) $attributes[0]['virtualservers_total_maxclients'],
            (int) $attributes[0]['virtualservers_total_clients_online'],
            (int) $attributes[0]['virtualservers_total_channels_online'],
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
