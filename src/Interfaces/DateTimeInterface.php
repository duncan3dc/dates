<?php

namespace duncan3dc\Dates\Interfaces;

use duncan3dc\Dates\Month;
use duncan3dc\Dates\Year;

interface DateTimeInterface extends FormatInterface
{
    /**
     * Get the datetime as a unix timestamp.
     */
    public function timestamp(): int;


    /**
     * Get a Month object for this date.
     */
    public function getMonth(): MonthInterface;


    /**
     * Get a Year object for this date.
     */
    public function getYear(): YearInterface;


    /**
     * Get a unix timestamp for 12pm on this date.
     */
    public function midday(): int;


    /**
     * Get a unix timestamp for the start of this date.
     */
    public function start(): int;


    /**
     * Get a unix timestamp for the end of this date.
     */
    public function end(): int;


    /**
     * Check if this object is a bank holiday.
     */
    public function isBankHoliday(): bool;


    /**
     * Check if this date is the specified day.
     *
     * @param int $day The ISO-8601 number of the day
     */
    public function isDay(int $day): bool;


    /**
     * Check if this date is a monday.
     */
    public function isMonday(): bool;


    /**
     * Check if this date is a tuesday.
     */
    public function isTuesday(): bool;


    /**
     * Check if this date is a wednesday.
     */
    public function isWednesday(): bool;


    /**
     * Check if this date is a thursday.
     */
    public function isThursday(): bool;


    /**
     * Check if this date is a friday.
     */
    public function isFriday(): bool;


    /**
     * Check if this date is a saturday.
     */
    public function isSaturday(): bool;


    /**
     * Check if this date is a sunday.
     */
    public function isSunday(): bool;


    /**
     * Check if this date is a weekday.
     */
    public function isWeekday(): bool;


    /**
     * Check if this date is a weekend.
     */
    public function isWeekend(): bool;


    /**
     * Get a date object for the previous occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     */
    public function getPrevious(int $day): DateTimeInterface;


    /**
     * Get a date object for the next occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     */
    public function getNext(int $day): DateTimeInterface;


    /**
     * Get a new instance but with the specified year.
     *
     * @param int $year The year to use
     */
    public function withYear(int $year): DateTimeInterface;


    /**
     * Get a new instance but with the specified month.
     *
     * @param int $month The month to use
     */
    public function withMonth(int $month): DateTimeInterface;


    /**
     * Get a new instance but with the specified day.
     *
     * @param int $day The day to use
     */
    public function withDay(int $day): DateTimeInterface;


    /**
     * Get a new instance but with the specified hour.
     *
     * @param int $hour The hour to use
     */
    public function withHours(int $hour): DateTimeInterface;


    /**
     * Get a new instance but with the specified minute.
     *
     * @param int $minute The minute to use
     */
    public function withMinutes(int $minute): DateTimeInterface;


    /**
     * Get a new instance but with the specified second.
     *
     * @param int $second The second to use
     */
    public function withSeconds(int $second): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     */
    public function addDays(int $days): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to subtract
     */
    public function subDays(int $days): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     */
    public function addWeeks(int $weeks): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to subtract
     */
    public function subWeeks(int $weeks): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     */
    public function subMonths(int $months): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     */
    public function addSeconds(int $seconds): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to subtract
     */
    public function subSeconds(int $seconds): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     */
    public function addMinutes(int $minutes): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     */
    public function subMinutes(int $minutes): DateTimeInterface;

    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     */
    public function addHours(int $hours): DateTimeInterface;


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     */
    public function subHours(int $hours): DateTimeInterface;
}
