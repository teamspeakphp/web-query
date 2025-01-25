<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums\Transporter;

enum Method: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
}
