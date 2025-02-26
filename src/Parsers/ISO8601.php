<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Parse an ISO8601 formatted date/time into a unix timestamp.
 */
class ISO8601 extends AbstractParser
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $date, $matches)) {
            $time = $this->parseTime($time);
            return mktime($time["h"], $time["m"], $time["s"], $matches[2], $matches[3], $matches[1]);
        }

        return null;
    }
}
