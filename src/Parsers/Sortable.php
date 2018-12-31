<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

use function is_numeric;

/**
 * Sortable format (Ymd with optional separate time).
 */
final class Sortable extends AbstractParser implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (!is_numeric($date)) {
            return null;
        }
        $date = (int) $date;

        if ($date < 99999999) {
            $date = (string) $date;

            $y = (int) substr($date, 0, 4);
            $m = (int) substr($date, 4, 2);
            $d = (int) substr($date, 6, 2);

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y) ?: null;
        }

        return null;
    }
}
