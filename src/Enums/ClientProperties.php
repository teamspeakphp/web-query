<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum ClientProperties: string
{
    /**
     * Unique ID of the client.
     */
    case ClientUniqueIdentifier = 'client_unique_identifier';

    /**
     * Nickname of the client. Changeable.
     */
    case ClientNickname = 'client_nickname';

    /**
     * Client version information including build number.
     */
    case ClientVersion = 'client_version';

    /**
     * Operating system the client is running on.
     */
    case ClientPlatform = 'client_platform';

    /**
     * Indicates whether the client has their microphone muted or not.
     */
    case ClientInputMuted = 'client_input_muted';

    /**
     * Indicates whether the client has their speakers muted or not.
     */
    case ClientOutputMuted = 'client_output_muted';

    /**
     * Indicates whether the client has enabled their capture device or not.
     */
    case ClientInputHardware = 'client_input_hardware';

    /**
     * Indicates whether the client has enabled their playback device or not.
     */
    case ClientOutputHardware = 'client_output_hardware';

    /**
     * Default channel of the client.
     */
    case ClientDefaultChannel = 'client_default_channel';

    /**
     * Username of a ServerQuery client.
     */
    case ClientLoginName = 'client_login_name';

    /**
     * Database ID of the client.
     */
    case ClientDatabaseId = 'client_database_id';

    /**
     * Current channel group ID of the client.
     */
    case ClientChannelGroupId = 'client_channel_group_id';

    /**
     * Current server group IDs of the client separated by a comma.
     */
    case ClientServerGroups = 'client_server_groups';

    /**
     * Creation date and time of the clients first connection to the server as UTC timestamp.
     */
    case ClientCreated = 'client_created';

    /**
     * Creation date and time of the clients last connection to the server as UTC timestamp.
     */
    case ClientLastConnected = 'client_lastconnected';

    /**
     * Total number of connections from this client since the server was started.
     */
    case ClientTotalConnections = 'client_totalconnections';

    /**
     * Indicates whether the client is away or not.
     */
    case ClientAway = 'client_away';

    /**
     * Away message of the client.
     */
    case ClientAwayMessage = 'client_away_message';

    /**
     * Indicates whether the client is a ServerQuery client or not.
     */
    case ClientType = 'client_type';

    /**
     * Indicates whether the client has set an avatar or not.
     */
    case ClientFlagAvatar = 'client_flag_avatar';

    /**
     * The clients current talk power.
     */
    case ClientTalkPower = 'client_talk_power';

    /**
     * Indicates whether the client is requesting talk power or not.
     */
    case ClientTalkRequest = 'client_talk_request';

    /**
     * The clients current talk power request message.
     */
    case ClientTalkRequestMsg = 'client_talk_request_msg';

    /**
     * Indicates whether the client is able to talk or not. Changeable.
     */
    case ClientIsTalker = 'client_is_talker';

    /**
     * Number of bytes downloaded by the client on the current month.
     */
    case ClientMonthBytesDownloaded = 'client_month_bytes_downloaded';

    /**
     * Number of bytes uploaded by the client on the current month.
     */
    case ClientMonthBytesUploaded = 'client_month_bytes_uploaded';

    /**
     * Number of bytes downloaded by the client since the server was started.
     */
    case ClientTotalBytesDownloaded = 'client_total_bytes_downloaded';

    /**
     * Number of bytes uploaded by the client since the server was started.
     */
    case ClientTotalBytesUploaded = 'client_total_bytes_uploaded';

    /**
     * Indicates whether the client is a priority speaker or not.
     */
    case ClientIsPrioritySpeaker = 'client_is_priority_speaker';

    /**
     * Number of unread offline messages in this clients inbox.
     */
    case ClientUnreadMessages = 'client_unread_messages';

    /**
     * Phonetic name of the client.
     */
    case ClientNicknamePhonetic = 'client_nickname_phonetic';

    /**
     * Brief description of the client. Changeable.
     */
    case ClientDescription = 'client_description';

    /**
     * The clients current ServerQuery view power.
     */
    case ClientNeededServerQueryViewPower = 'client_needed_serverquery_view_power';

    /**
     * Current bandwidth used for outgoing file transfers (Bytes/s).
     */
    case ConnectionFileTransferBandwidthSent = 'connection_filetransfer_bandwidth_sent';

    /**
     * Current bandwidth used for incoming file transfers (Bytes/s).
     */
    case ConnectionFileTransferBandwidthReceived = 'connection_filetransfer_bandwidth_received';

    /**
     * Total amount of packets sent.
     */
    case ConnectionPacketsSentTotal = 'connection_packets_sent_total';

    /**
     * Total amount of packets received.
     */
    case ConnectionPacketsReceivedTotal = 'connection_packets_received_total';

    /**
     * Total amount of bytes sent.
     */
    case ConnectionBytesSentTotal = 'connection_bytes_sent_total';

    /**
     * Total amount of bytes received.
     */
    case ConnectionBytesReceivedTotal = 'connection_bytes_received_total';

    /**
     * Average bandwidth used for outgoing data in the last second (Bytes/s).
     */
    case ConnectionBandwidthSentLastSecondTotal = 'connection_bandwidth_sent_last_second_total';

    /**
     * Average bandwidth used for incoming data in the last second (Bytes/s).
     */
    case ConnectionBandwidthReceivedLastSecondTotal = 'connection_bandwidth_received_last_second_total';

    /**
     * Average bandwidth used for outgoing data in the last minute (Bytes/s).
     */
    case ConnectionBandwidthSentLastMinuteTotal = 'connection_bandwidth_sent_last_minute_total';

    /**
     * Average bandwidth used for incoming data in the last minute (Bytes/s).
     */
    case ConnectionBandwidthReceivedLastMinuteTotal = 'connection_bandwidth_received_last_minute_total';

    /**
     * The IPv4 address of the client.
     */
    case ConnectionClientIp = 'connection_client_ip';

    /**
     * Indicates whether the client is a channel commander or not. Changeable.
     */
    case ClientIsChannelCommander = 'client_is_channel_commander';

    /**
     * CRC32 checksum of the client icon. Changeable.
     */
    case ClientIconId = 'client_icon_id';

    /**
     * The country identifier of the client (i.e. DE).
     */
    case ClientCountry = 'client_country';
}
