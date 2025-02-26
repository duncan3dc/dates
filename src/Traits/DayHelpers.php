<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\Days;

/**
 * Check if this instance is a particular day.
 */
trait DayHelpers
{
    /**
     * Check if this date is the specified day.
     *
     * @param int $day The ISO-8601 number of the day
     */
    public function isDay(int $day): bool
    {
        $day = (int) $day;
        return ($this->numeric("N") === $day);
    }


    /**
     * Check if this date is a monday.
     */
    public function isMonday(): bool
    {
        return $this->isDay(Days::MONDAY);
    }


    /**
     * Check if this date is a tuesday.
     */
    public function isTuesday(): bool
    {
        return $this->isDay(Days::TUESDAY);
    }


    /**
     * Check if this date is a wednesday.
     */
    public function isWednesday(): bool
    {
        return $this->isDay(Days::WEDNESDAY);
    }


    /**
     * Check if this date is a thursday.
     */
    public function isThursday(): bool
    {
        return $this->isDay(Days::THURSDAY);
    }


    /**
     * Check if this date is a friday.
     */
    public function isFriday(): bool
    {
        return $this->isDay(Days::FRIDAY);
    }


    /**
     * Check if this date is a saturday.
     */
    public function isSaturday(): bool
    {
        return $this->isDay(Days::SATURDAY);
    }


    /**
     * Check if this date is a sunday.
     */
    public function isSunday(): bool
    {
        return $this->isDay(Days::SUNDAY);
    }


    /**
     * Check if this date is a weekday.
     */
    public function isWeekday(): bool
    {
        return ($this->numeric("N") <= Days::FRIDAY);
    }


    /**
     * Check if this date is a weekend.
     */
    public function isWeekend(): bool
    {
        return ($this->numeric("N") >= Days::SATURDAY);
    }


    /**
     * Get a date object for the previous occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     */
    public function getPrevious(int $day): DateTime
    {
        # Don't include today as we want the 'previous' instance
        $date = $this->subDays(1);

        $current = $date->format("N");
        if ($current < $day) {
            $day -= 7;
        }

        $adjust = $current - $day;

        return $date->subDays($adjust);
    }


    /**
     * Get a date object for the next occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     */
    public function getNext(int $day): DateTime
    {
        # Don't include today as we want the 'next' instance
        $date = $this->addDays(1);

        $current = $date->format("N");
        if ($current > $day) {
            $day += 7;
        }

        $adjust = $day - $current;

        return $date->addDays($adjust);
    }
}
