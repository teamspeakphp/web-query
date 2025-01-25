<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

final readonly class Status
{
    private function __construct(
        private int $code,
        private string $message,
        private ?string $extraMessage,
    ) {}

    /**
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

    public function code(): int
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function extraMessage(): ?string
    {
        return $this->extraMessage;
    }
}
