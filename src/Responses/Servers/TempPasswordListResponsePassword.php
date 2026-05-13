<?php

declare(strict_types=1);

namespace TeamSpeak\WebQuery\Responses\Servers;

final readonly class TempPasswordListResponsePassword
{
    private function __construct(
        public string $nickname,
        public string $uid,
        public string $description,
        public string $password,
        public int $start,
        public int $end,
        public int $channelId,
    ) {}

    /**
     * @param  array{nickname: string, uid: string, desc: string, pw_clear: string, start: string, end: string, tcid: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['nickname'],
            $attributes['uid'],
            $attributes['desc'],
            $attributes['pw_clear'],
            (int) $attributes['start'],
            (int) $attributes['end'],
            (int) $attributes['tcid'],
        );
    }
}
