<?php

namespace Regatta\Dates\Parsers;

/**
 * Sortable format (Ymd with optional separate time)
 */
class Sortable extends AbstractParser
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
        if ($date < 99999999) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);

            if (!$time && strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            }
            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }
    }
}
