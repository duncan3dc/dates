<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Sortable format (Year and month only).
 */
class SortableYearMonth extends AbstractParser
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if ($date < 999999) {
            $y = floor($date / 100);
            $m = $date % 100;
            return mktime(12, 0, 0, $m, 1, $y);
        }

        return null;
    }
}
