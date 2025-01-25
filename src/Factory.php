<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery;

use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Exceptions\InvalidConfiguration;
use TeamSpeak\WebQuery\Transporters\HttpTransporter;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;

final class Factory
{
    private ?string $baseUri = null;

    private ?string $apiKey = null;

    private ?int $virtualServer = null;

    private ?int $port = null;

    private ?ClientInterface $httpClient = null;

    /**
     * @var array<string, string>
     */
    private array $headers = [];

    /**
     * Set the base URI.
     */
    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Set the API key.
     */
    public function withApiKey(string $apiKey): self
    {
        $this->apiKey = mb_trim($apiKey);

        return $this;
    }

    /**
     * Set the ID of the virtual server.
     */
    public function withVirtualServer(?int $virtualServer): self
    {
        $this->virtualServer = $virtualServer;

        return $this;
    }

    /**
     * Set the port of the virtual server.
     */
    public function withPort(?int $port): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Set the HTTP client.
     */
    public function withHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Add the HTTP header.
     */
    public function withHttpHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Create a new configured instance of the client.
     *
     * @throws InvalidConfiguration
     */
    public function make(): Client
    {
        if ($this->baseUri === null) {
            throw new InvalidConfiguration('Base URI is not set.');
        }

        if ($this->virtualServer === null && $this->port === null) {
            throw new InvalidConfiguration('Either virtual server or port must be set.');
        }

        $headers = Headers::create();

        if ($this->apiKey !== null) {
            $headers = Headers::withXApiKey(ApiKey::from($this->apiKey));
        }

        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        $baseUri = $this->baseUri;

        if ($this->virtualServer !== null) {
            $baseUri .= '/'.$this->virtualServer;
        } else {
            $baseUri .= '/byport/'.$this->port;
        }

        $baseUri = BaseUri::from($baseUri);

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();

        $transporter = new HttpTransporter($client, $baseUri, $headers);

        return new Client($transporter);
    }
}
