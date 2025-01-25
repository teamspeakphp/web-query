<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\PermissionsContract;

final class Permissions implements PermissionsContract
{
    use Concerns\Transportable;
}
