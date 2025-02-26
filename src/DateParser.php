<?php

namespace duncan3dc\Dates;

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
     */
    public function parse(string|int $date, string|int|null $time = null): Date
    {
        $result = parent::parse($date, 0);

        return new Date($result->timestamp());
    }
}
