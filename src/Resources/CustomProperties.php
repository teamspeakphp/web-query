<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Resources;

use TeamSpeak\WebQuery\Contracts\Resources\CustomPropertiesContract;
use TeamSpeak\WebQuery\Enums\Query\Command;
use TeamSpeak\WebQuery\Responses\CustomProperties\InfoResponse;
use TeamSpeak\WebQuery\Responses\CustomProperties\SearchResponse;
use TeamSpeak\WebQuery\ValueObjects\Transporter\Payload;

final class CustomProperties implements CustomPropertiesContract
{
    use Concerns\Transportable;

    /**
     * Searches for clients with a custom property matching the given ident and pattern.
     */
    public function search(string $ident, string $pattern): SearchResponse
    {
        $payload = new Payload(
            command: Command::CustomSearch,
            parameters: ['ident' => $ident, 'pattern' => $pattern],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string, ident: string, value: string}>> $response */
        $response = $this->transporter->request($payload);

        return SearchResponse::from($response->body());
    }

    /**
     * Displays all custom properties for the client with the given database ID.
     */
    public function info(int $clientDatabaseId): InfoResponse
    {
        $payload = new Payload(
            command: Command::CustomInfo,
            parameters: ['cldbid' => $clientDatabaseId],
        );

        /** @var \TeamSpeak\WebQuery\ValueObjects\Transporter\Response<list<array{cldbid: string, ident: string, value: string}>> $response */
        $response = $this->transporter->request($payload);

        return InfoResponse::from($response->body());
    }
}
