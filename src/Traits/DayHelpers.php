<?php

namespace Regatta\Dates\Traits;

use Regatta\Dates\Interfaces\Days;

/**
 * Get a new DateTime object relative to the current one
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
     * @return boolean
     */
    public function isMonday()
    {
        return $this->isDay(Days::MONDAY);
    }


    /**
     * Check if this date is a tuesday.
     *
     * @return boolean
     */
    public function isTuesday()
    {
        return $this->isDay(Days::TUESDAY);
    }


    /**
     * Check if this date is a wednesday.
     *
     * @return boolean
     */
    public function isWednesday()
    {
        return $this->isDay(Days::WEDNESDAY);
    }


    /**
     * Check if this date is a thursday.
     *
     * @return boolean
     */
    public function isThursday()
    {
        return $this->isDay(Days::THURSDAY);
    }


    /**
     * Check if this date is a friday.
     *
     * @return boolean
     */
    public function isFriday()
    {
        return $this->isDay(Days::FRIDAY);
    }


    /**
     * Check if this date is a saturday.
     *
     * @return boolean
     */
    public function isSaturday()
    {
        return $this->isDay(Days::SATURDAY);
    }


    /**
     * Check if this date is a sunday.
     *
     * @return boolean
     */
    public function isSunday()
    {
        return $this->isDay(Days::SUNDAY);
    }


    /**
     * Check if this date is a weekday.
     *
     * @return boolean
     */
    public function isWeekday()
    {
        return ($this->numeric("N") <= Days::FRIDAY);
    }


    /**
     * Check if this date is a weekend.
     *
     * @return boolean
     */
    public function isWeekend()
    {
        return ($this->numeric("N") >= Days::SATURDAY);
    }
}
