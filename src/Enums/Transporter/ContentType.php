<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums\Transporter;

enum ContentType: string
{
    case JSON = 'application/json';
    case TEXT_PLAIN = 'text/plain';
}
