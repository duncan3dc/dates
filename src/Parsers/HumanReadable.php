<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Human readable format (d/m/y or d-m-y).
 */
class HumanReadable extends AbstractParser
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
        if (strpos($date, "/") || strpos($date, "-")) {

            $char = strpos($date, "/") ? "/" : "-";
            list($d, $m, $y) = explode($char, $date);

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }
    }
}
