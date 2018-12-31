<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Sortable format (Year and month only).
 */
class SortableYearMonth implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time): ?int
    {
        if ($date < 999999) {
            $y = (int) floor($date / 100);
            $m = $date % 100;
            return mktime(12, 0, 0, $m, 1, $y);
        }

        return null;
    }
}
