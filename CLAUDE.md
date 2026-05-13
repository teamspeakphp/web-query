# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
composer test              # full suite: refactor check + lint check + types + type-coverage + unit tests
composer test:unit         # Pest unit tests with coverage (min 100%)
composer test:types        # PHPStan at max level (src/ only)
composer test:lint         # Pint code style check
composer test:refactor     # Rector dry-run
composer test:type-coverage # Pest type coverage (min 100%)
composer lint              # apply Pint formatting
composer refactor          # apply Rector refactors
```

Run a single test file or by name:
```bash
./vendor/bin/pest tests/Unit/Resources/ServerGroupsTest.php
./vendor/bin/pest --filter "list"
```

## Architecture

The package is a PSR-18 HTTP client wrapper for the TeamSpeak 3 WebQuery API.

### Entry point

`src/TeamSpeak.php` is autoloaded as a **file** (not a namespaced class), defining a global `TeamSpeak` class. It exposes two static methods: `TeamSpeak::client(baseUri, apiKey, virtualServer)` for quick setup, and `TeamSpeak::factory()` returning a `Factory` builder.

### Request flow

```
TeamSpeak (global) → Factory → Client → Resource → HttpTransporter → PSR-18 HTTP client
```

1. `Factory` validates config, builds `BaseUri`, `Headers` (with `X-API-Key`), discovers a PSR-18 client via `php-http/discovery`, constructs `HttpTransporter`, returns `Client`.
2. `Client` holds a `TransporterContract` and exposes resource accessors (`->channels()`, `->serverGroups()`, etc.).
3. Each **Resource** (`src/Resources/`) uses the `Transportable` trait for its constructor, creates a `Payload(Command, parameters[], options[])`, calls `$this->transporter->request($payload)`, and maps the raw response to a typed `Response` DTO.
4. `HttpTransporter` converts `Payload` → PSR-7 `Request` (always POST, JSON body), sends it, validates the TS3 status block, returns `Response<list<array<string,string>>>`.

### Payload and options

`Payload` takes three constructor args:
- `Command` enum (maps to the URL path suffix, e.g. `Command::ServerGroupList` → `servergrouplist`)
- `parameters` — key/value pairs sent as JSON body; `null` values are stripped; booleans become `"1"`/`"0"`
- `options` — boolean flags; `true` values become `"-flagname" => ""` in the JSON body

### Response format

TS3 WebQuery returns `{"body": [...], "status": {"code": int, "message": string}}`. Status code `0` (`ok`) and `1281` (`database empty result set`) are treated as success. All other codes throw `ErrorException`.

### Response DTOs

`src/Responses/**` are `final readonly` classes with a single static `from(array $attributes): self` constructor. Nested items (e.g. `ListResponseGroup`) follow the same pattern. All properties are `public readonly`.

### Contracts

Every resource has a contract in `src/Contracts/Resources/` that it implements. `ClientContract` lists all resource accessor methods. `TransporterContract` has a single `request(Payload): Response` method — this is the only mock boundary in tests.

### Testing pattern

Tests mock `Psr\Http\Client\ClientInterface` (Mockery), wire it into a real `HttpTransporter`, and pass that to the resource under test. Mock responses are `GuzzleHttp\Psr7\Response` objects with a JSON body matching the TS3 response shape. Tests assert both the outgoing request body and the returned DTO structure.

### Type strictness

- PHPStan level max on `src/`
- 100% type coverage enforced via `pest --type-coverage`
- 100% code coverage enforced via `pest --coverage --min=100`
- Rector runs `deadCode`, `codeQuality`, `typeDeclarations`, `privatization`, `earlyReturn`, `strictBooleans`, and `withPhpSets()`

### Adding a new resource

1. Add `Command` case(s) to `src/Enums/Query/Command.php`
2. Create `src/Contracts/Resources/FooContract.php`
3. Create `src/Resources/Foo.php` implementing the contract, using `Concerns\Transportable`
4. Create response DTOs under `src/Responses/Foo/`
5. Add accessor `public function foo(): Foo` to `Client` and `ClientContract`
6. Add tests under `tests/Unit/Resources/FooTest.php` and `tests/Unit/Responses/Foo/`
