<?php

declare(strict_types=1);

namespace Tk\Clock;

/**
 * PSR-20 Clock Interface (draft)
 * @link https://github.com/php-fig/fig-standards/blob/master/proposed/clock.md
 */
interface ClockInterface extends \StellaMaris\Clock\ClockInterface
{
    // 外部ライブラリ依存の緩衝レイヤー

    /**
     * Returns the current time as a DateTimeImmutable Object
     */
    public function now(): \DateTimeImmutable;
}
