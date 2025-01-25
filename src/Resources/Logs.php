<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\LogsContract;

final class Logs implements LogsContract
{
    use Concerns\Transportable;
}
