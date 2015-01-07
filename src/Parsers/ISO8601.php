<?php

namespace Regatta\Dates\Parsers;

/**
 * Parse an ISO8601 formatted date/time into a unix timestamp.
 */
class ISO8601 extends AbstractParser
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
        if (preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $date, $matches)) {
            $time = $this->parseTime($time);
            return mktime($time["h"], $time["m"], $time["s"], $matches[2], $matches[3], $matches[1]);
        }
    }
}
