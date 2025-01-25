<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ServerGroupsContract;

final class ServerGroups implements ServerGroupsContract
{
    use Concerns\Transportable;
}
