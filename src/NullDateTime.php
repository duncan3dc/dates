<?php

namespace duncan3dc\Dates;

/**
 * A class to respresent a unix timestamp and allow convenient methods.
 */
class NullDateTime extends DateTime
{
    use Traits\DayHelpers;
    use Traits\RelativeDateTimes;


    /**
     * Create a new instance from a unix timestamp.
     *
     * @param int A unix timestamp
     */
    public function __construct($unix = null)
    {
        $this->unix = 0;
    }


    /**
     * Format the date unsing the specified format and return a string.
     *
     * @var string $format The format to apply to the date
     *
     * @return string
     */
    public function string($format)
    {
        return "n/a";
    }


    /**
     * Get a unix timestamp for 12pm on this date.
     *
     * @return int
     */
    public function midday()
    {
        return 0;
    }


    /**
     * Get a unix timestamp for the start of this date.
     *
     * @return int
     */
    public function start()
    {
        return 0;
    }


    /**
     * Get a unix timestamp for the end of this date.
     *
     * @return int
     */
    public function end()
    {
        return 0;
    }


    /**
     * Check if this object is a bank holiday.
     *
     * @return bool
     */
    public function isBankHoliday()
    {
        return false;
    }


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return DateTime
     */
    public function isDay($day)
    {
        return false;
    }


    /**
     * Check if this date is a weekday.
     *
     * @return bool
     */
    public function isWeekday()
    {
        return false;
    }


    /**
     * Check if this date is a weekend.
     *
     * @return bool
     */
    public function isWeekend()
    {
        return false;
    }


    /**
     * Get the details of the financial period for this date.
     *
     * @var string $format The format to apply to the date, only the characters m, n, y, Y and numbers may be used
     *
     * @return string|int
     */
    public function formatPeriod($format)
    {
        return "n/a";
    }


    /**
     * Get the financial year of this date.
     *
     * @return int
     */
    public function getFinancialYear()
    {
        return 0;
    }


    /**
     * Get the financial period of this date.
     *
     * @return int
     */
    public function getFinancialPeriod()
    {
        return 0;
    }


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return static
     */
    public function addDays($days)
    {
        return $this;
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return static
     */
    public function addMonths($months)
    {
        return $this;
    }


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     *
     * @return static
     */
    public function addSeconds($seconds)
    {
        return $this;
    }
}
