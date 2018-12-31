<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * IBM DB2 format (cymd with optional separate time).
 */
final class IbmDb2 extends AbstractParser implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if ($date < 9999999) {
            $y = floor($date / 10000) + 1900;
            $m = floor((int) ($date / 100) % 100);
            $d = $date % 100;

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }

        return null;
    }
}
