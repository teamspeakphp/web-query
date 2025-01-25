<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

/**
 * @internal
 */
final readonly class Status
{
    private function __construct(
        private int $code,
        private string $message,
        private ?string $extraMessage,
    ) {}

    /**
     * Create a status from the associative array.
     *
     * @param  array{code: int, message: string, extra_message?: string}  $data
     */
    public static function from(array $data): self
    {
        return new self(
            $data['code'],
            $data['message'],
            $data['extra_message'] ?? null,
        );
    }

    /**
     * Get the status code.
     */
    public function code(): int
    {
        return $this->code;
    }

    /**
     * Get the status message.
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * Get the status extra message.
     */
    public function extraMessage(): ?string
    {
        return $this->extraMessage;
    }
}
