<?php

namespace Regatta\Dates\Traits;

use Regatta\Dates\DateTime;

/**
 * Get a new DateTime object relative to the current one
 */
trait RelativeDateTimes
{

    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return DateTime
     */
    public function addDays($days)
    {
        $days = (int) $days;
        if ($days === 0) {
            return $this;
        }

        return new DateTime(mktime(
            $this->numeric("H"),
            $this->numeric("i"),
            $this->numeric("s"),
            $this->numeric("n"),
            $this->numeric("j") + $days,
            $this->numeric("Y")
        ));
    }



    /**
     * Get a DateTime object for the previous day.
     *
     * @return DateTime
     */
    public function previousDay()
    {
        return $this->addDays(-1);
    }


    /**
     * Get a DateTime object for the next day.
     *
     * @return DateTime
     */
    public function nextDay()
    {
        return $this->addDays(1);
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return DateTime
     */
    public function addMonths($months)
    {
        $months = (int) $months;
        if ($months === 0) {
            return $this;
        }

        $date = new DateTime(mktime($this->numeric("H"), $this->numeric("i"), $this->numeric("s"), $this->numeric("n") + $months, 1, $this->numeric("Y")));

        # Prevent the month from wrapping when using a date that doesn't exist in that month
        $day = $this->numeric("j");
        $max = $date->numeric("t");
        if ($day > $max) {
            $day = $max;
        }

        return new DateTime(mktime($this->numeric("H"), $this->numeric("i"), $this->numeric("s"), $this->numeric("n") + $months, $day, $this->numeric("Y")));
    }



    /**
     * Get a DateTime object for the previous month.
     *
     * @return DateTime
     */
    public function previousMonth()
    {
        return $this->addMonths(-1);
    }


    /**
     * Get a DateTime object for the next month.
     *
     * @return DateTime
     */
    public function nextMonth()
    {
        return $this->addMonths(1);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return DateTime
     */
    public function addYears($years)
    {
        # Use addMonths to take advantage of the day wrapping handling, as years always have 12 months
        return $this->addMonths($years * 12);
    }



    /**
     * Get a DateTime object for the previous year.
     *
     * @return DateTime
     */
    public function previousYear()
    {
        return $this->addYears(-1);
    }


    /**
     * Get a DateTime object for the next year.
     *
     * @return DateTime
     */
    public function nextYear()
    {
        return $this->addYears(1);
    }
}
