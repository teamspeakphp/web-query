<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\BansContract;

final class Bans implements BansContract
{
    use Concerns\Transportable;
}
