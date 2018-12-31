<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\MonthInterface;

/**
 * A representation of a month.
 */
class Month extends Range implements MonthInterface
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

        $start = Date::mkdate($date->numeric("Y"), $date->numeric("n"), 1);
        $end = Date::mkdate($date->numeric("Y"), $date->numeric("n"), $date->numeric("t"));
        parent::__construct($start, $end);
    }
}
