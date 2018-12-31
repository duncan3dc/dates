<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
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
     *
     * @return bool
     */
    public function isDay(int $day): bool
    {
        return ($this->numeric("N") === $day);
    }


    /**
     * Check if this date is a monday.
     *
     * @return bool
     */
    public function isMonday(): bool
    {
        return $this->isDay(Days::MONDAY);
    }


    /**
     * Check if this date is a tuesday.
     *
     * @return bool
     */
    public function isTuesday(): bool
    {
        return $this->isDay(Days::TUESDAY);
    }


    /**
     * Check if this date is a wednesday.
     *
     * @return bool
     */
    public function isWednesday(): bool
    {
        return $this->isDay(Days::WEDNESDAY);
    }


    /**
     * Check if this date is a thursday.
     *
     * @return bool
     */
    public function isThursday(): bool
    {
        return $this->isDay(Days::THURSDAY);
    }


    /**
     * Check if this date is a friday.
     *
     * @return bool
     */
    public function isFriday(): bool
    {
        return $this->isDay(Days::FRIDAY);
    }


    /**
     * Check if this date is a saturday.
     *
     * @return bool
     */
    public function isSaturday(): bool
    {
        return $this->isDay(Days::SATURDAY);
    }


    /**
     * Check if this date is a sunday.
     *
     * @return bool
     */
    public function isSunday(): bool
    {
        return $this->isDay(Days::SUNDAY);
    }


    /**
     * Check if this date is a weekday.
     *
     * @return bool
     */
    public function isWeekday(): bool
    {
        return ($this->numeric("N") <= Days::FRIDAY);
    }


    /**
     * Check if this date is a weekend.
     *
     * @return bool
     */
    public function isWeekend(): bool
    {
        return ($this->numeric("N") >= Days::SATURDAY);
    }


    /**
     * @inheritdoc
     */
    public function getPrevious(int $day): DateTimeInterface
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
     * @inheritdoc
     */
    public function getNext($day): DateTimeInterface
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
