<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Human readable format (d/m/y or d-m-y).
 */
class HumanReadable extends AbstractParser
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (strpos($date, "/") || strpos($date, "-")) {
            $char = strpos($date, "/") ? "/" : "-";
            list($d, $m, $y) = explode($char, $date);

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }

        return null;
    }
}
