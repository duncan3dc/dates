<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

use function is_numeric;

/**
 * Sortable format (YmdHi/YmdHis).
 */
final class SortableDateTime implements ParserInterface
{
    public function parse(string|int $date, string|int|null $time): ?int
    {
        if (!is_numeric($date)) {
            return null;
        }
        $date = (int) $date;

        if ($date > 200000000000) {
            $date = (string) $date;
            $y = (int) substr($date, 0, 4);
            $m = (int) substr($date, 4, 2);
            $d = (int) substr($date, 6, 2);
            $h = (int) substr($date, 8, 2);
            $i = (int) substr($date, 10, 2);

            # The seconds parameter is optional so ensure it is there
            if (strlen($date) > 12) {
                $s = (int) substr($date, 12, 2);
            } else {
                $s = 0;
            }

            return mktime($h, $i, $s, $m, $d, $y) ?: null;
        }

        return null;
    }
}
