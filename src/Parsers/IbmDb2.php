<?php

namespace duncan3dc\Dates\Parsers;

use duncan3dc\Dates\Interfaces\ParserInterface;

/**
 * IBM DB2 format (cymd with optional separate time).
 */
class IbmDb2 extends AbstractParser implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time): ?int
    {
        if ($date < 9999999) {
            $y = (int) floor($date / 10000) + 1900;
            $m = (int) floor(($date / 100) % 100);
            $d = $date % 100;

            $time = $this->parseTime($time);

            return mktime($time["h"], $time["m"], $time["s"], $m, $d, $y);
        }

        return null;
    }
}
