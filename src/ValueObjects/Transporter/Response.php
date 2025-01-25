<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

/**
 * @template TBody of list<array<string, string>>|array{}
 *
 * @internal
 */
final readonly class Response
{
    /**
     * @param  TBody  $body
     */
    private function __construct(private array $body) {}

    /**
     * Create a response from the associative array.
     *
     * @param  TBody  $body
     * @return Response<TBody>
     */
    public static function from(array $body): self
    {
        return new self($body);
    }

    /**
     * Get the response body.
     *
     * @return TBody
     */
    public function body(): array
    {
        return $this->body;
    }
}
