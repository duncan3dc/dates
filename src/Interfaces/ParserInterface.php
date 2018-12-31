<?php

namespace duncan3dc\Dates\Interfaces;

interface ParserInterface
{
    /**
     * Convert a parsable date/time into a unix timestamp.
     *
     * @param string|int $date The date to parse
     * @param string|int|null $time The time to parse
     */
    public function parse(string|int $date, string|int|null $time): ?int;
}
