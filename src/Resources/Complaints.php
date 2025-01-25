<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ComplaintsContract;

final class Complaints implements ComplaintsContract
{
    use Concerns\Transportable;
}
