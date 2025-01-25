<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * @param  array{code: int, message: string, extra_message?: string}  $contents
     */
    public function __construct(private readonly array $contents, private readonly int $statusCode)
    {
        $message = ($contents['message'] ?: (string) $this->contents['code']) ?: 'Unknown error';
        if (isset($contents['extra_message'])) {
            $message .= ': '.$contents['extra_message'];
        }

        parent::__construct($message);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error code.
     */
    public function getErrorCode(): int
    {
        return $this->contents['code'];
    }
}
