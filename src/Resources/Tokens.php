<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\TokensContract;

final class Tokens implements TokensContract
{
    use Concerns\Transportable;
}
