# PHP TeamSpeak 3 WebQuery client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teamspeakphp/web-query.svg?style=flat-square)](https://packagist.org/packages/teamspeakphp/web-query)
[![Tests](https://img.shields.io/github/actions/workflow/status/teamspeakphp/web-query/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/teamspeakphp/web-query/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/teamspeakphp/web-query.svg?style=flat-square)](https://packagist.org/packages/teamspeakphp/web-query)

PHP TeamSpeak 3 WebQuery client.

> Note: This package is still under active development and is not yet ready for production use.

## Features

To see all commands that implemented, see [COMMANDS](COMMANDS.md).

## Installation

> **Requires [PHP 8.4+](https://php.net/releases/)**

You can install the package via composer:

```bash
composer require teamspeakphp/web-query
```

## Usage

To print names of the all channels:

```php
$teamspeak = TeamSpeak::client('100.100.100.100:10080', 'my-api-key', 1);
$channels = $teamspeak->channels()->list()->channels;

foreach ($channels as $channel) {
    echo 'Found channel '.$channel->name.PHP_EOL;
}
```

To print nicknames with IP addresses of the first 100 clients in the database:

```php
$teamspeak = TeamSpeak::client('100.100.100.100:10080', 'my-api-key', 1);
$clients = $teamspeak->databaseClients()->list(limit: 100)->clients;

foreach ($clients as $client) {
    echo sprintf('Database client: %s (%s)', $client->nickname, $client->lastIpAddress);
}
```

Method `TeamSpeak::client(...)` connects to the server through ID of the virtual server, but you can connect through the port of your server using the factory:

```php
$teamspeak = TeamSpeak::factory()
    ->withBaseUri('100.100.100.100:10080')
    ->withApiKey('my-api-key')
    ->withPort(9987)
    ->make();
```

## Testing

```bash
composer test
```
