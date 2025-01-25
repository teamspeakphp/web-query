<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Enums;

enum Codec: int
{
    /**
     * Mono, 16bit, 8kHz.
     */
    case SpeexNarrowband = 0;

    /**
     * Mono, 16bit, 16kHz.
     */
    case SpeexWideband = 1;

    /**
     * Mono, 16bit, 32kHz.
     */
    case SpeexUltraWideband = 2;

    /**
     * Mono, 16bit, 48kHz.
     */
    case CeltMono = 3;

    /**
     * Mono, 16bit, 48kHz, optimized for voice.
     */
    case OpusVoice = 4;

    /**
     * Stereo, 16bit, 48kHz, optimized for music.
     */
    case OpusMusic = 5;
}
