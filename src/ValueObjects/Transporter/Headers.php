<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

use TeamSpeak\WebQuery\Enums\Transporter\ContentType;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;

final readonly class Headers
{
    /**
     * @param  array<string, string>  $headers
     */
    public function __construct(private array $headers) {}

    public static function create(): self
    {
        return new self([]);
    }

    public static function withXApiKey(ApiKey $apiKey): self
    {
        return new self([
            'X-Api-Key' => $apiKey->toString(),
        ]);
    }

    public function withContentType(ContentType $contentType): self
    {
        return new self([
            ...$this->headers,
            'Content-Type' => $contentType->value,
        ]);
    }

    public function withCustomHeader(string $name, string $value): self
    {
        return new self([
            ...$this->headers,
            $name => $value,
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
