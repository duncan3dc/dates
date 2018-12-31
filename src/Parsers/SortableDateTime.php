<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Sortable format (YmdHi/YmdHis).
 */
final class SortableDateTime implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if ($date > 200000000000) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);
            $h = substr($date, 8, 2);
            $i = substr($date, 10, 2);

            # The seconds parameter is optional so ensure it is there
            if (strlen($date) > 12) {
                $s = substr($date, 12, 2);
            } else {
                $s = 0;
            }

            return mktime($h, $i, $s, $m, $d, $y);
        }

        return null;
    }
}
