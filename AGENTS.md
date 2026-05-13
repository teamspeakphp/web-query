# AGENTS.md

Guidance for AI agents working in this repository.

## Project

`teamspeakphp/web-query` — PHP 8.4+ Composer package. PSR-18 HTTP client for the TeamSpeak 3 WebQuery API.

## Commands

```bash
composer test              # full suite (run before any commit)
composer test:unit         # unit tests only
composer test:types        # PHPStan static analysis
composer test:lint         # code style check (Pint)
composer test:refactor     # Rector dry-run
composer lint              # auto-fix code style
composer refactor          # auto-apply Rector refactors
./vendor/bin/pest --filter "test name"   # single test by name
./vendor/bin/pest tests/path/to/File.php # single file
```

## Quality gates (all enforced in CI)

- PHPStan level max on `src/`
- 100% code coverage (`pest --coverage --min=100`)
- 100% type coverage (`pest --type-coverage --min=100`)
- Pint code style
- Rector refactors (no unapplied suggestions)

## Architecture

### Request lifecycle

```
TeamSpeak::client() / TeamSpeak::factory()
  → Factory (builds transporter + client)
  → Client (resource accessors)
  → Resource (builds Payload, calls transporter)
  → HttpTransporter (PSR-18, JSON)
  → TS3 WebQuery HTTP API
```

### Key classes

| Class | Purpose |
|---|---|
| `src/TeamSpeak.php` | Global entry point (file-autoloaded, no namespace) |
| `src/Factory.php` | Builder — validates config, creates `HttpTransporter` + `Client` |
| `src/Client.php` | Holds `TransporterContract`, exposes resource accessors |
| `src/Resources/*.php` | One class per TS3 resource area; uses `Transportable` trait |
| `src/Transporters/HttpTransporter.php` | PSR-18 adapter; parses TS3 response envelope |
| `src/ValueObjects/Transporter/Payload.php` | Encapsulates a command + parameters + option flags |
| `src/Responses/**` | Typed readonly DTOs; all have `static from(array): self` |
| `src/Enums/Query/Command.php` | All TS3 WebQuery API commands as a string-backed enum |

### Payload construction

- `parameters` — key/value; `null` stripped, `bool` → `"1"`/`"0"`, arrays pass through unchanged
- `options` — boolean flags; `true` → `"-flagname" => ""` in JSON body
- Always sent as POST with `Content-Type: application/json`

### TS3 response envelope

```json
{"body": [{...}, ...], "status": {"code": 0, "message": "ok"}}
```

`body` may be absent (void operations). Status code `0` = ok, `1281` = empty result set (also ok). Anything else → `ErrorException`.

### Testing approach

Tests use real `HttpTransporter` with a mocked `Psr\Http\Client\ClientInterface` (Mockery). Never mock `HttpTransporter` itself — tests verify both the outgoing request body and the returned DTO. Response fixtures are `GuzzleHttp\Psr7\Response` objects.

### Conventions

- All PHP files: `declare(strict_types=1)`
- Response DTOs: `final readonly class` with `public readonly` properties
- Resources: `final class` implementing the matching contract, no direct `__construct` (inherited via `Transportable` trait)
- Contracts mirror the public API exactly; keep them in sync when adding methods
- New TS3 commands go into `Command` enum before anything else
