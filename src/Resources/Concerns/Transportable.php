<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources\Concerns;

use TeamSpeak\WebQuery\Contracts\TransporterContract;

trait Transportable
{
    public function __construct(private readonly TransporterContract $transporter) {}
}
