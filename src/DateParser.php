<?php

namespace Regatta\Dates;

/**
 * The date only portion of a DateTimeParser object.
 */
class DateParser extends DateTimeParser
{
    /**
     * Create a new Date object from a parsable date.
     *
     * @param string|int The date to parse
     * @param string|int The time to parse (ignored, use the DateTimeParser for time parsing)
     *
     * @return Date
     */
    public function parse($date, $time = null)
    {
        return parent::parse($date, 0);
    }
}
