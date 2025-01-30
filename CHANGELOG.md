# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [v0.2.2](https://github.com/teamspeakphp/web-query/compare/v0.2.1...v0.2.2) - 2025-01-30

### Documentation
- (phpdoc) Fixed DocBlocks for public methods to remove PHPStan warnings.

## [v0.2.1](https://github.com/teamspeakphp/web-query/compare/v0.2.0...v0.2.1) - 2025-01-30

### Fixed
- (server-groups) Add missed properties to `GetClientsResponseClient`.

## [v0.2.0](https://github.com/teamspeakphp/web-query/compare/v0.1.0...v0.2.0) - 2025-01-30

### Added
- Server groups (#4).
- Clients (#2).
- Messages (#6).
- Bans (#3).

### Changed
- Handle `database empty result set` without exception (#1).

### Fixed
- Wrong signature message sending.
- Wrong enum `LogLevel` values.
- Wrong enum `TextMessageTargetMode` values.
- Undefined array key when empty result.
- False parameter converts to empty string.

### Tests
- Fix message sending tests.
- Fix `targetmode` in message tests.

### Documentation
- Update README.md handling database empty result set (#1).
- Add DocBlocks to public methods (#5).

## v0.1.0 - 2025-01-25
- Adds First Version.

