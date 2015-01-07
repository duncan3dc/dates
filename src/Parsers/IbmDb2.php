<?php

namespace Regatta\Dates\Parsers;

/**
 * IBM DB2 format (cymd with optional separate time).
 */
class IbmDb2 extends AbstractParser
{
    /**
     * Convert a parsable date/time into a unix timestamp.
     *
     * @param string|int The date to parse
     * @param string|int The time to parse
     *
     * @return int
     */
    public function parse($date, $time)
    {
        if ($date < 9999999) {
            $y = floor($date / 10000) + 1900;
            $m = floor(($date / 100) % 100);
            $d = $date % 100;

            if (!$time && strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            }
            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }
    }
}
