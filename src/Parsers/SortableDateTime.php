<?php

namespace Regatta\Dates\Parsers;

/**
 * Sortable format (YmdHi/YmdHis).
 */
class SortableDateTime extends AbstractParser
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
        if ($date > 200000000000) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);
            $h = substr($date, 8, 2);
            $i = substr($date, 10, 2);
            $s = substr($date, 12, 2);
            return mktime($h, $i, $s, $m, $d, $y);
        }
    }
}
