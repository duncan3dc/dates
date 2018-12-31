<?php

namespace duncan3dc\Dates\Interfaces;

interface ParserInterface
{
    /**
     * Convert a parsable date/time into a unix timestamp.
     *
     * @param string|int $date The date to parse
     * @param string|int $time The time to parse
     *
     * @return int|null
     */
    public function parse($date, $time): ?int;
}
