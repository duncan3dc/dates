<?php

namespace Regatta\Dates;

/**
 * A representation of a year.
 */
class Year extends Range
{
    use Traits\Formatting;

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
}
