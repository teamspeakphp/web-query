<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum GroupNameMode: int
{
    case None = 0;
    case Before = 1;
    case After = 2;
}
