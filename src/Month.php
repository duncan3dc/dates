<?php

namespace duncan3dc\Dates;

/**
 * A representation of a month.
 */
class Month extends Range
{
    use Traits\Formatting;

    /**
     * Create a new Month object representing the current date.
     *
     * @return static
     */
    public static function now()
    {
        return new static(Date::now());
    }

    /**
     * Create a new instance from a date object.
     *
     * @param DateTime $date A date within the season
     */
    public function __construct(DateTime $date)
    {
        $this->unix = $date->timestamp();

        $start = Date::mkdate($date->numeric("Y"), $date->numeric("n"), 1);
        $end = Date::mkdate($date->numeric("Y"), $date->numeric("n"), $date->numeric("t"));
        parent::__construct($start, $end);
    }
}
