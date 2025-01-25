<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

use TeamSpeak\WebQuery\Enums\Transporter\ContentType;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;

/**
 * @internal
 */
final readonly class Headers
{
    /**
     * @param  array<string, string>  $headers
     */
    public function __construct(private array $headers) {}

    /**
     * Create a new empty instance of headers.
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Create a new instance of headers with the specified X-Api-Key.
     */
    public static function withXApiKey(ApiKey $apiKey): self
    {
        return new self([
            'X-Api-Key' => $apiKey->toString(),
        ]);
    }

    /**
     * Get a copy instance of headers with the specified Content-Type.
     */
    public function withContentType(ContentType $contentType): self
    {
        return new self([
            ...$this->headers,
            'Content-Type' => $contentType->value,
        ]);
    }

    /**
     * Get a copy instance of headers with the specified header.
     */
    public function withCustomHeader(string $name, string $value): self
    {
        return new self([
            ...$this->headers,
            $name => $value,
        ]);
    }

    /**
     * Get the headers as associative array.
     *
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
