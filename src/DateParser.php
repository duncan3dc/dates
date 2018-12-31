<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * The date only portion of a DateTimeParser object.
 */
class DateParser extends DateTimeParser
{
    /**
     * @inheritdoc
     */
    public function parse($date, $time = null): DateTimeInterface
    {
        $result = parent::parse($date, null);

        return new Date($result->timestamp());
    }
}
