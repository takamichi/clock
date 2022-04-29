<?php

declare(strict_types=1);

namespace Tk\Clock;

use DateTimeImmutable;

/**
 * システムの現在日時を返す。
 */
final class SystemClock implements ClockInterface
{
    private \DateTimeZone $timezone;

    public function __construct(?\DateTimeZone $timezone = null)
    {
        $this->timezone = $timezone ?? new \DateTimeZone(\date_default_timezone_get());
    }

    public function now(): DateTimeImmutable
    {
        try {
            return new \DateTimeImmutable('now', $this->timezone);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
