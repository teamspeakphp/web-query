<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class InstanceInfoResponse
{
    private function __construct(
        public int $databaseVersion,
        public int $fileTransferPort,
        public int $maxDownloadTotalBandwidth,
        public int $maxUploadTotalBandwidth,
        public int $guestServerQueryGroup,
        public int $serverQueryFloodCommands,
        public int $serverQueryFloodTime,
        public int $serverQueryBanTime,
        public int $templateServerAdminGroup,
        public int $templateServerDefaultGroup,
        public int $templateChannelAdminGroup,
        public int $templateChannelDefaultGroup,
        public int $permissionsVersion,
        public int $pendingConnectionsPerIp,
    ) {}

    /**
     * @param  array{0: array{serverinstance_database_version: string, serverinstance_filetransfer_port: string, serverinstance_max_download_total_bandwidth: string, serverinstance_max_upload_total_bandwidth: string, serverinstance_guest_serverquery_group: string, serverinstance_serverquery_flood_commands: string, serverinstance_serverquery_flood_time: string, serverinstance_serverquery_ban_time: string, serverinstance_template_serveradmin_group: string, serverinstance_template_serverdefault_group: string, serverinstance_template_channeladmin_group: string, serverinstance_template_channeldefault_group: string, serverinstance_permissions_version: string, serverinstance_pending_connections_per_ip: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['serverinstance_database_version'],
            (int) $attributes[0]['serverinstance_filetransfer_port'],
            (int) $attributes[0]['serverinstance_max_download_total_bandwidth'],
            (int) $attributes[0]['serverinstance_max_upload_total_bandwidth'],
            (int) $attributes[0]['serverinstance_guest_serverquery_group'],
            (int) $attributes[0]['serverinstance_serverquery_flood_commands'],
            (int) $attributes[0]['serverinstance_serverquery_flood_time'],
            (int) $attributes[0]['serverinstance_serverquery_ban_time'],
            (int) $attributes[0]['serverinstance_template_serveradmin_group'],
            (int) $attributes[0]['serverinstance_template_serverdefault_group'],
            (int) $attributes[0]['serverinstance_template_channeladmin_group'],
            (int) $attributes[0]['serverinstance_template_channeldefault_group'],
            (int) $attributes[0]['serverinstance_permissions_version'],
            (int) $attributes[0]['serverinstance_pending_connections_per_ip'],
        );
    }
}
