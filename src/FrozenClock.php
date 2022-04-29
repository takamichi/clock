<?php

declare(strict_types=1);

namespace Tk\Clock;

use DateTimeImmutable;

/**
 * 現在日時として、凍結した同じ日時を常に返す。
 */
final class FrozenClock implements ClockInterface
{
    private \DateTimeImmutable $now;

    public function __construct(\DateTimeInterface $now)
    {
        // PHP 8.0 以上であれば `createFromInterface()` で済むが、
        // PHP 7.4 をサポートするための条件分岐を実装。

        if (PHP_MAJOR_VERSION >= 8) {
            $this->now = DateTimeImmutable::createFromInterface($now);
        } elseif ($now instanceof DateTimeImmutable) {
            // DateTimeImmutable を継承したミュータブルなクラスを考慮して、クローンしたインスタンスを保持する。
            $this->now = clone $now;
        } elseif ($now instanceof \DateTime) {
            $this->now = DateTimeImmutable::createFromMutable($now);
        } else {
            try {
                $this->now = DateTimeImmutable::createFromFormat('U.u', $now->format('U.u'))
                    ->setTimezone($now->getTimezone());
            } catch (\Exception $e) {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }
}
