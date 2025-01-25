<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ChannelGroupsContract;

final class ChannelGroups implements ChannelGroupsContract
{
    use Concerns\Transportable;
}
