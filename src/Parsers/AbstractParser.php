<?php

namespace duncan3dc\Dates\Parsers;

/**
 * Parse a date/time format into a unix timestamp.
 */
abstract class AbstractParser
{
    /**
     * Convert a parsable date/time into a unix timestamp.
     *
     * @param string|int $date The date to parse
     * @param string|int $time The time to parse
     */
    abstract public function parse(string|int $date, string|int|null $time): ?int;

    /**
     * Convert the time to an array of hours, minutes and seconds.
     *
     * @param string|int $time The value to parse.
     *
     * @return array<string, int>
     */
    protected function parseTime(string|int|null $time): array
    {
        $return = [
            "h" =>  12,
            "m" =>  0,
            "s" =>  0,
        ];

        if (!$time) {
            return $return;
        }

        if (preg_match("/[a-z]/i", (string) $time)) {
            return $return;
        }

        # Human readable format (h:i:s)
        if (strpos((string) $time, ":")) {
            $bits = explode(":", (string) $time);
            return [
                "h" =>  (int) $bits[0],
                "m" =>  isset($bits[1]) ? (int) $bits[1] : 0,
                "s" =>  isset($bits[2]) ? (int) $bits[2] : 0,
            ];
        }

        # Sortable format (His)
        $time = (int) $time;
        return [
            "h" =>  (int) floor($time / 10000),
            "m" =>  floor($time / 100) % 100,
            "s" =>  $time % 100,
        ];
    }
}
