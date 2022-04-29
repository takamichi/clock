<?php

declare(strict_types=1);

namespace Tk\Clock;

use DateTimeImmutable;

/**
 * 常に現在日時をUTCで返す。
 */
final class UtcClock implements ClockInterface
{
    private ClockInterface $clock;

    public function __construct(ClockInterface $clock = null)
    {
        $this->clock = $clock ?? new SystemClock();
    }

    public function now(): DateTimeImmutable
    {
        return $this->clock->now()->setTimezone(new \DateTimeZone('UTC'));
    }
}
