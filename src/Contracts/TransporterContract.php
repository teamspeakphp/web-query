<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Contracts;

use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Response;

/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Make a request from the given payload.
     *
     * @return Response<list<array<string, string>>|array{}>
     */
    public function request(Payload $payload): Response;
}
