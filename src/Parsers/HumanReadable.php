<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Human readable format (d/m/y or d-m-y).
 */
class HumanReadable extends AbstractParser implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time): ?int
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
