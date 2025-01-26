<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Messages;

final readonly class GetResponse
{
    private function __construct(
        public int $id,
        public string $senderUniqueIdentifier,
        public string $subject,
        public string $message,
    ) {}

    /**
     * @param  array{0: array{msgid: string, cluid: string, subject: string, message: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            (int) $attributes[0]['msgid'],
            $attributes[0]['cluid'],
            $attributes[0]['subject'],
            $attributes[0]['message'],
        );
    }
}
