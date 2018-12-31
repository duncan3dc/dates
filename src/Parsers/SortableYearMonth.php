<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Sortable format (Year and month only).
 */
final class SortableYearMonth implements ParserInterface
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
