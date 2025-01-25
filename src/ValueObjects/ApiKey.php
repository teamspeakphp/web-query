<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects;

use TeamSpeak\WebQuery\Contracts\StringableContract;

final readonly class ApiKey implements StringableContract
{
    private function __construct(public string $apiKey) {}

    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    public function toString(): string
    {
        return $this->apiKey;
    }
}
