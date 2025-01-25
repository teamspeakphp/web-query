<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\MessagesContract;

final class Messages implements MessagesContract
{
    use Concerns\Transportable;
}
