<?php

namespace duncan3dc\Dates;

/**
 * A representation of a year.
 */
class Year extends Range
{
    use Traits\Formatting;
    use Traits\Range;

    /**
     * Create a new instance from a date object.
     *
     * @param DateTime $date A date within the season
     */
    public function __construct(DateTime $date)
    {
        $this->unix = $date->timestamp();

        $start = Date::mkdate($date->numeric("Y"), 1, 1);
        $end = Date::mkdate($date->numeric("Y"), 12, 31);
        parent::__construct($start, $end);
    }


    /**
     * Create a new instance of the Year class from a numeric 4 digit year.
     *
     * @param $year The 4 digit year (eg 2015)
     *
     * @return static
     */
    public static function fromInt($year)
    {
        $date = Date::mkdate($year, 1, 1);
        return new static($date);
    }
}
