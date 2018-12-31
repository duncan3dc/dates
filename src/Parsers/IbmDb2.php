<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

use function is_numeric;

/**
 * IBM DB2 format (cymd with optional separate time).
 */
final class IbmDb2 extends AbstractParser implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (!is_numeric($date)) {
            return null;
        }
        $date = (int) $date;

        if ($date < 9999999) {
            $y = (int) floor($date / 10000) + 1900;
            $m = (int) floor((int) ($date / 100) % 100);
            $d = $date % 100;

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y) ?: null;
        }

        return null;
    }
}
