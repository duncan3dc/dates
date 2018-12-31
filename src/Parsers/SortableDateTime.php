<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * Sortable format (YmdHi/YmdHis).
 */
class SortableDateTime implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time): ?int
    {
        if ($date > 200000000000) {
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

            return mktime($h, $i, $s, $m, $d, $y);
        }

        return null;
    }
}
