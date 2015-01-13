<?php

namespace Regatta\Dates\Traits;

use Regatta\Dates\Date;

/**
 * Get a new Date object relative to the current one
 */
trait RelativeDates
{

    /**
     * Get a Date object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return Date
     */
    public function addMonths($months)
    {
        $months = (int) $months;
        if ($months === 0) {
            return $this;
        }

        $date = new Date(mktime(12, 0, 0, date("n", $this->unix) + $months, 1, date("Y", $this->unix)));

        # Prevent the month from wrapping when using a date that doesn't exist in that month
        $day = $this->numeric("j");
        $max = $date->numeric("t");
        if ($day > $max) {
            $day = $max;
        }

        return new Date(mktime(12, 0, 0, date("n", $this->unix) + $months, $day, date("Y", $this->unix)));
    }


    /**
     * Get a Date object for the previous month.
     *
     * @return Date
     */
    public function previousMonth()
    {
        return $this->addMonths(-1);
    }


    /**
     * Get a Date object for the next month.
     *
     * @return Date
     */
    public function nextMonth()
    {
        return $this->addMonths(1);
    }


    /**
     * Get a Date object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return Date
     */
    public function addYears($years)
    {
        # Use addMonths to take advantage of the day wrapping handling, as years always have 12 months
        return $this->addMonths($years * 12);
    }



    /**
     * Get a Date object for the previous year.
     *
     * @return Date
     */
    public function previousYear()
    {
        return $this->addYears(-1);
    }


    /**
     * Get a Date object for the next year.
     *
     * @return Date
     */
    public function nextYear()
    {
        return $this->addYears(1);
    }
}
