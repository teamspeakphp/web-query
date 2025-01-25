<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\ComplainsContract;

final class Complains implements ComplainsContract
{
    use Concerns\Transportable;
}
