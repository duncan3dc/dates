<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Human readable format (d/m/y or d-m-y).
 */
final class HumanReadable extends AbstractParser implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        $date = (string) $date;

        if (strpos($date, "/") || strpos($date, "-")) {
            $char = strpos($date, "/") ? "/" : "-";
            list($d, $m, $y) = explode($char, $date);

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], (int) $m, (int) $d, (int) $y) ?: null;
        }

        return null;
    }
}
