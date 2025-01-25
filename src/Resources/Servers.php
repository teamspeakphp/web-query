<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ServersContract;

final class Servers implements ServersContract
{
    use Concerns\Transportable;
}
