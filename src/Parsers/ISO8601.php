<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Parse an ISO8601 formatted date/time into a unix timestamp.
 */
final class ISO8601 extends AbstractParser implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        $date = (string) $date;

        if (preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $date, $matches)) {
            $time = $this->parseTime($time);
            return mktime($time["h"], $time["m"], $time["s"], (int) $matches[2], (int) $matches[3], (int) $matches[1]) ?: null;
        }

        return null;
    }
}
