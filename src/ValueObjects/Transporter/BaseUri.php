<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

use TeamSpeak\WebQuery\Contracts\StringableContract;

final readonly class BaseUri implements StringableContract
{
    private function __construct(private string $baseUri) {}

    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }

    public function toString(): string
    {
        $baseUri = mb_rtrim($this->baseUri, '/');

        foreach (['http://', 'https://'] as $protocol) {
            if (str_starts_with($baseUri, $protocol)) {
                return "$baseUri/";
            }
        }

        return "https://$baseUri/";
    }
}
