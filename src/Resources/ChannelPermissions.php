<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ChannelPermissionsContract;

final class ChannelPermissions implements ChannelPermissionsContract
{
    use Concerns\Transportable;
}
