<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\CustomPropertiesContract;

final class CustomProperties implements CustomPropertiesContract
{
    use Concerns\Transportable;
}
