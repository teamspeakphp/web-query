<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use JsonException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Enums\Transporter\ContentType;
use TeamSpeak\WebQuery\Enums\Transporter\Method;
use TeamSpeak\WebQuery\Exceptions\InvalidParameter;

/**
 * @internal
 */
final readonly class Payload
{
    /**
     * @param  array<string, mixed>  $parameters
     * @param  array<string, bool>  $options
     */
    public function __construct(
        private Command $command,
        private array $parameters = [],
        private array $options = [],
    ) {}

    /**
     * Create a request from the payload.
     *
     * @throws JsonException
     * @throws InvalidParameter
     */
    public function toRequest(BaseUri $baseUri, Headers $headers): RequestInterface
    {
        $psr17Factory = new Psr17Factory;

        $body = null;

        $uri = $baseUri->toString().$this->command->value;

        $headers = $headers->withContentType(ContentType::JSON);

        $arguments = array_filter($this->parameters, static fn (mixed $value): bool => $value !== null);

        foreach ($arguments as $key => $value) {
            if (is_array($value)) {
                continue;
            }

            if (! is_scalar($value)) {
                throw new InvalidParameter(sprintf('Not scalar value for parameter "%s": %s', $key, gettype($value)));
            }

            if (is_bool($value)) {
                $value = $value ? '1' : '0';
            }

            $arguments[$key] = (string) $value;
        }

        foreach ($this->options as $flagName => $flagValue) {
            if ($flagValue === true) {
                $arguments["-$flagName"] = '';
            }
        }

        if ($arguments !== []) {
            $body = $psr17Factory->createStream(json_encode($arguments, JSON_THROW_ON_ERROR));
        }

        $request = $psr17Factory->createRequest(Method::POST->value, $uri);

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
