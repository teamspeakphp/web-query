<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use TeamSpeak\WebQuery\Client;
use TeamSpeak\WebQuery\Responses\WhoAmI\WhoAmIResponse;
use TeamSpeak\WebQuery\Transporters\HttpTransporter;
use TeamSpeak\WebQuery\ValueObjects\ApiKey;
use TeamSpeak\WebQuery\ValueObjects\Transporter\BaseUri;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Headers;

beforeEach(function () {
    $this->httpClient = Mockery::mock(ClientInterface::class);

    $apiKey = ApiKey::from('foo');

    $http = new HttpTransporter(
        $this->httpClient,
        BaseUri::from('teamspeak.com'),
        Headers::withXApiKey($apiKey),
    );

    $this->client = new Client($http);
});

test('whoami', function () {
    $response = new Response(200, ['Content-Type' => 'application/json'], json_encode([
        'body' => [[
            'client_channel_id' => '1',
            'client_database_id' => '1',
            'client_id' => '14',
            'client_login_name' => '<internal>',
            'client_nickname' => 'serveradmin',
            'client_origin_server_id' => '0',
            'client_unique_identifier' => 'serveradmin',
            'virtualserver_id' => '1',
            'virtualserver_port' => '9987',
            'virtualserver_status' => 'online',
            'virtualserver_unique_identifier' => 'dwcJxlwg51mhDP1nlVQh51sIIzo=',
        ]],
        'status' => ['code' => 0, 'message' => 'ok'],
    ]));

    $this->httpClient
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $result = $this->client->whoami();

    expect($result)->toBeInstanceOf(WhoAmIResponse::class)
        ->and($result->clientId)->toBe(14);
});
