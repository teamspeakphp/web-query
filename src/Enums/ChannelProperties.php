<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum ChannelProperties: string
{
    /**
     * Name of the channel. Changeable.
     */
    case ChannelName = 'channel_name';

    /**
     * Topic of the channel. Changeable.
     */
    case ChannelTopic = 'channel_topic';

    /**
     * Description of the channel. Changeable.
     */
    case ChannelDescription = 'channel_description';

    /**
     * Password of the channel. Changeable.
     */
    case ChannelPassword = 'channel_password';

    /**
     * Indicates whether the channel has a password set or not.
     */
    case ChannelFlagPassword = 'channel_flag_password';

    /**
     * Codec used by the channel (see {@see Code}). Changeable.
     */
    case ChannelCodec = 'channel_codec';

    /**
     * Codec quality used by the channel. Changeable.
     */
    case ChannelCodecQuality = 'channel_codec_quality';

    /**
     * Individual max number of clients for the channel. Changeable.
     */
    case ChannelMaxClients = 'channel_maxclients';

    /**
     * Individual max number of clients for the channel family. Changeable.
     */
    case ChannelMaxFamilyClients = 'channel_maxfamilyclients';

    /**
     * ID of the channel below which the channel is positioned. Changeable.
     */
    case ChannelOrder = 'channel_order';

    /**
     * Indicates whether the channel is permanent or not. Changeable.
     */
    case ChannelFlagPermanent = 'channel_flag_permanent';

    /**
     * Indicates whether the channel is semi-permanent or not. Changeable.
     */
    case ChannelFlagSemiPermanent = 'channel_flag_semi_permanent';

    /**
     * Indicates whether the channel is temporary or not. Changeable.
     */
    case ChannelFlagTemporary = 'channel_flag_temporary';

    /**
     * Indicates whether the channel is the virtual servers default channel or not. Changeable.
     */
    case ChannelFlagDefault = 'channel_flag_default';

    /**
     * Indicates whether the channel has a max clients limit or not. Changeable.
     */
    case ChannelFlagMaxClientsUnlimited = 'channel_flag_maxclients_unlimited';

    /**
     * Indicates whether the channel has a max family clients limit or not. Changeable.
     */
    case ChannelFlagMaxFamilyClientsUnlimited = 'channel_flag_maxfamilyclients_unlimited';

    /**
     * Indicates whether the channel inherits the max family clients from his parent channel or not. Changeable.
     */
    case ChannelFlagMaxFamilyClientsInherited = 'channel_flag_maxfamilyclients_inherited';

    /**
     * Needed talk power for this channel. Changeable.
     */
    case ChannelNeededTalkPower = 'channel_needed_talk_power';

    /**
     * Phonetic name of the channel. Changeable.
     */
    case ChannelNamePhonetic = 'channel_name_phonetic';

    /**
     * Path of the channels file repository.
     */
    case ChannelFilepath = 'channel_filepath';

    /**
     * Indicates whether the channel is silenced or not.
     */
    case ChannelForcedSilence = 'channel_forced_silence';

    /**
     * CRC32 checksum of the channel icon. Changeable.
     */
    case ChannelIconId = 'channel_icon_id';

    /**
     * Indicates whether speech data transmitted in this channel is encrypted or not. Changeable.
     */
    case ChannelCodecIsUnencrypted = 'channel_codec_is_unencrypted';

    /**
     * The channels parent ID. Changeable.
     */
    case CpId = 'cpid';

    /**
     * The channels ID.
     */
    case Cid = 'cid';
}
