<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Transporters;

use JsonException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use TeamSpeak\WebQuery\Contracts\TransporterContract;
use TeamSpeak\WebQuery\Enums\Transporter\ContentType;
use TeamSpeak\WebQuery\Exceptions\ErrorException;
use TeamSpeak\WebQuery\Exceptions\InvalidResponse;
use TeamSpeak\WebQuery\Exceptions\UnserializableResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Response;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Status;

final readonly class HttpTransporter implements TransporterContract
{
    public function __construct(
        private ClientInterface $client,
        private BaseUri $baseUri,
        private Headers $headers,
    ) {}

    /**
     * @return Response<list<array<string, string>>|array{}>
     *
     * @throws JsonException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws ErrorException
     * @throws InvalidResponse
     * @throws UnserializableResponse
     * @throws \TeamSpeak\WebQuery\Exceptions\InvalidParameter
     */
    public function request(Payload $payload): Response
    {
        $request = $payload->toRequest($this->baseUri, $this->headers);

        $response = $this->client->sendRequest($request);

        $contents = $response->getBody()->getContents();

        $this->throwIfJsonError($response, $contents);

        try {
            /** @var array{body?: list<array<string, string>>, status: array{code: int, message: string, extra_message?: string}} $data */
            $data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return Response::from($data['body'] ?? []);
    }

    /**
     * @throws ErrorException
     * @throws UnserializableResponse
     * @throws InvalidResponse
     */
    private function throwIfJsonError(ResponseInterface $response, string $contents): void
    {
        if (! str_contains($response->getHeaderLine('Content-Type'), ContentType::JSON->value)) {
            return;
        }

        $statusCode = $response->getStatusCode();

        try {
            /** @var array{status?: array{code: int, message: string, extra_message?: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (! isset($response['status'])) {
            throw new InvalidResponse('Invalid response: missing status key.');
        }

        $status = Status::from($response['status']);

        if ($status->code() === 0 && $status->message() === 'ok') {
            return;
        }

        throw new ErrorException($response['status'], $statusCode);
    }
}
