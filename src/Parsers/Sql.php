<?php

namespace Regatta\Dates\Parsers;

/**
 * Sql date format (yyyy-mm-dd hh:ii:ss) (with optional milliseconds).
 */
class Sql extends AbstractParser
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
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})[\s-]([0-9]{2})[:\.]([0-9]{2})[:\.]([0-9]{2})(\.[0-9]{6})?$/", $date, $matches)) {
            return mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]);
        }
    }
}
