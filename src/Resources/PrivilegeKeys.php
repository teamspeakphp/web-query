<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\PrivilegeKeysContract;

final class PrivilegeKeys implements PrivilegeKeysContract
{
    use Concerns\Transportable;
}
