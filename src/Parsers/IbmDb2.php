<?php

namespace duncan3dc\Dates\Parsers;

/**
 * IBM DB2 format (cymd with optional separate time).
 */
class IbmDb2 extends AbstractParser
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
