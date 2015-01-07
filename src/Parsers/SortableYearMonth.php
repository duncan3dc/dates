<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Sortable format (Year and month only).
 */
class SortableYearMonth extends AbstractParser
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
        if ($date < 999999) {
            $y = floor($date / 100);
            $m = $date % 100;
            return mktime(12, 0, 0, $m, 1, $y);
        }
    }
}
