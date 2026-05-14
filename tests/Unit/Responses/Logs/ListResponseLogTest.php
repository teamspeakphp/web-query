<?php

declare(strict_types=1);

use TeamSpeak\WebQuery\Enums\LogLevel;
use TeamSpeak\WebQuery\Responses\Logs\ListResponseLog;

test('from info', function () {
    $log = ListResponseLog::from([
        'l' => '2024-06-22 20:03:05.123456|INFO    |VirtualServer |1  |client connected',
    ]);

    expect($log->timestamp)->toBeInstanceOf(DateTimeImmutable::class)
        ->and($log->timestamp->getTimezone()->getName())->toBe('UTC')
        ->and($log->timestamp->format('Y-m-d H:i:s'))->toBe('2024-06-22 20:03:05')
        ->and($log->level)->toBe(LogLevel::Info)
        ->and($log->channel)->toBe('VirtualServer')
        ->and($log->serverId)->toBe(1)
        ->and($log->message)->toBe('client connected');
});

test('from warning', function () {
    $log = ListResponseLog::from([
        'l' => '2024-06-22 20:03:05.000000|WARNING |Query         |0  |something suspicious',
    ]);

    expect($log->level)->toBe(LogLevel::Warning)
        ->and($log->channel)->toBe('Query')
        ->and($log->serverId)->toBe(0)
        ->and($log->message)->toBe('something suspicious');
});

test('from error', function () {
    $log = ListResponseLog::from([
        'l' => '2024-06-22 20:03:05.000000|ERROR   |VirtualServer |2  |something failed',
    ]);

    expect($log->level)->toBe(LogLevel::Error)
        ->and($log->serverId)->toBe(2)
        ->and($log->message)->toBe('something failed');
});

test('from debug', function () {
    $log = ListResponseLog::from([
        'l' => '2024-06-22 20:03:05.000000|DEBUG   |VirtualServer |1  |debug message',
    ]);

    expect($log->level)->toBe(LogLevel::Debug)
        ->and($log->message)->toBe('debug message');
});
