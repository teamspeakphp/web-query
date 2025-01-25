<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects;

use TeamSpeak\WebQuery\Contracts\StringableContract;

/**
 * @internal
 */
final readonly class ApiKey implements StringableContract
{
    private function __construct(public string $apiKey) {}

    /**
     * Create an API key from the string.
     */
    public static function from(string $apiKey): self
    {
        return new self($apiKey);
    }

    /**
     * Return the API key as string.
     */
    public function toString(): string
    {
        return $this->apiKey;
    }
}
