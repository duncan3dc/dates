<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\YearInterface;

/**
 * A representation of a year.
 */
class Year extends Range implements YearInterface
{
    use Traits\Formatting;
    use Traits\Range;

    /**
     * Create a new instance from a date object.
     *
     * @param DateTimeInterface $date A date within the season
     */
    public function __construct(DateTimeInterface $date)
    {
        $this->unix = $date->timestamp();

        $start = Date::mkdate($date->numeric("Y"), 1, 1);
        $end = Date::mkdate($date->numeric("Y"), 12, 31);
        parent::__construct($start, $end);
    }


    /**
     * Create a new instance of the Year class from a numeric 4 digit year.
     *
     * @param int $year The 4 digit year (eg 2015)
     *
     * @return Year
     */
    public static function fromInt(int $year): Year
    {
        $date = Date::mkdate($year, 1, 1);
        return new static($date);
    }
}
