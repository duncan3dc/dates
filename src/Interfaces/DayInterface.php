<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * Check if this instance is a particular day.
 */
interface DayInterface
{
    /**
     * Check if this date is the specified day.
     *
     * @param int $day The ISO-8601 number of the day
     *
     * @return bool
     */
    public function isDay(int $day): bool;


    /**
     * Check if this date is a monday.
     *
     * @return bool
     */
    public function isMonday(): bool;


    /**
     * Check if this date is a tuesday.
     *
     * @return bool
     */
    public function isTuesday(): bool;


    /**
     * Check if this date is a wednesday.
     *
     * @return bool
     */
    public function isWednesday(): bool;


    /**
     * Check if this date is a thursday.
     *
     * @return bool
     */
    public function isThursday(): bool;


    /**
     * Check if this date is a friday.
     *
     * @return bool
     */
    public function isFriday(): bool;


    /**
     * Check if this date is a saturday.
     *
     * @return bool
     */
    public function isSaturday(): bool;


    /**
     * Check if this date is a sunday.
     *
     * @return bool
     */
    public function isSunday(): bool;


    /**
     * Check if this date is a weekday.
     *
     * @return bool
     */
    public function isWeekday(): bool;


    /**
     * Check if this date is a weekend.
     *
     * @return bool
     */
    public function isWeekend(): bool;


    /**
     * Check if this object is a bank holiday.
     *
     * @return bool
     */
    public function isBankHoliday(): bool;
}
