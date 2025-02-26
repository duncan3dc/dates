<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Sortable format (Ymd with optional separate time).
 */
class Sortable extends AbstractParser
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if ($date < 99999999) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }

        return null;
    }
}
