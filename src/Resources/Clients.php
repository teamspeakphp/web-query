<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ClientsContract;

final class Clients implements ClientsContract
{
    use Concerns\Transportable;
}
