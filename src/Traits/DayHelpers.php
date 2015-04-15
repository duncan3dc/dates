<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\Interfaces\Days;

/**
 * Check if this instance is a particular day.
 */
trait DayHelpers
{
    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return DateTime
     */
    public function isDay($day)
    {
        $day = (int) $day;
        return ($this->numeric("N") === $day);
    }


    /**
     * Check if this date is a monday.
     *
     * @return bool
     */
    public function isMonday()
    {
        return $this->isDay(Days::MONDAY);
    }


    /**
     * Check if this date is a tuesday.
     *
     * @return bool
     */
    public function isTuesday()
    {
        return $this->isDay(Days::TUESDAY);
    }


    /**
     * Check if this date is a wednesday.
     *
     * @return bool
     */
    public function isWednesday()
    {
        return $this->isDay(Days::WEDNESDAY);
    }


    /**
     * Check if this date is a thursday.
     *
     * @return bool
     */
    public function isThursday()
    {
        return $this->isDay(Days::THURSDAY);
    }


    /**
     * Check if this date is a friday.
     *
     * @return bool
     */
    public function isFriday()
    {
        return $this->isDay(Days::FRIDAY);
    }


    /**
     * Check if this date is a saturday.
     *
     * @return bool
     */
    public function isSaturday()
    {
        return $this->isDay(Days::SATURDAY);
    }


    /**
     * Check if this date is a sunday.
     *
     * @return bool
     */
    public function isSunday()
    {
        return $this->isDay(Days::SUNDAY);
    }


    /**
     * Check if this date is a weekday.
     *
     * @return bool
     */
    public function isWeekday()
    {
        return ($this->numeric("N") <= Days::FRIDAY);
    }


    /**
     * Check if this date is a weekend.
     *
     * @return bool
     */
    public function isWeekend()
    {
        return ($this->numeric("N") >= Days::SATURDAY);
    }
}
