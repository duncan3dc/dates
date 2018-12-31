<?php

namespace duncan3dc\Dates\Interfaces;

use duncan3dc\Dates\Month;
use duncan3dc\Dates\Year;

interface DateTimeInterface extends FormatInterface, DayInterface
{
    /**
     * Get the datetime as a unix timestamp.
     *
     * @return int
     */
    public function timestamp(): int;


    /**
     * Get a Month object for this date.
     *
     * @return Month
     */
    public function getMonth(): MonthInterface;


    /**
     * Get a Year object for this date.
     *
     * @return Year
     */
    public function getYear(): YearInterface;


    /**
     * Get a unix timestamp for 12pm on this date.
     *
     * @return int
     */
    public function midday(): int;


    /**
     * Get a unix timestamp for the start of this date.
     *
     * @return int
     */
    public function start(): int;


    /**
     * Get a unix timestamp for the end of this date.
     *
     * @return int
     */
    public function end(): int;


    /**
     * Check if this object is a bank holiday.
     *
     * @return bool
     */
    public function isBankHoliday(): bool;


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
     * Get a date object for the previous occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     *
     * @return self
     */
    public function getPrevious(int $day): self;


    /**
     * Get a date object for the next occurrence of a specified day.
     *
     * @param int $day The numeric representation of the day.
     *
     * @return self
     */
    public function getNext(int $day): self;


    /**
     * Get a new instance but with the specified year.
     *
     * @param int $year The year to use
     *
     * @return self
     */
    public function withYear(int $year): self;


    /**
     * Get a new instance but with the specified month.
     *
     * @param int $month The month to use
     *
     * @return self
     */
    public function withMonth(int $month): self;


    /**
     * Get a new instance but with the specified day.
     *
     * @param int $day The day to use
     *
     * @return self
     */
    public function withDay(int $day): self;


    /**
     * Get a new instance but with the specified hour.
     *
     * @param int $hour The hour to use
     *
     * @return self
     */
    public function withHours(int $hour): self;


    /**
     * Get a new instance but with the specified minute.
     *
     * @param int $minute The minute to use
     *
     * @return self
     */
    public function withMinutes(int $minute): self;


    /**
     * Get a new instance but with the specified second.
     *
     * @param int $second The second to use
     *
     * @return self
     */
    public function withSeconds(int $second): self;


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return self
     */
    public function addDays(int $days): self;


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to subtract
     *
     * @return self
     */
    public function subDays(int $days): self;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     *
     * @return self
     */
    public function addWeeks(int $weeks): self;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to subtract
     *
     * @return self
     */
    public function subWeeks(int $weeks): self;


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return self
     */
    public function addMonths(int $months): self;


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     *
     * @return self
     */
    public function subMonths(int $months): self;


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return self
     */
    public function addYears(int $years): self;


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     *
     * @return self
     */
    public function subYears(int $years): self;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     *
     * @return self
     */
    public function addSeconds(int $seconds): self;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to subtract
     *
     * @return self
     */
    public function subSeconds(int $seconds): self;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     *
     * @return self
     */
    public function addMinutes(int $minutes): self;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     *
     * @return self
     */
    public function subMinutes(int $minutes): self;

    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     *
     * @return self
     */
    public function addHours(int $hours): self;


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     *
     * @return self
     */
    public function subHours(int $hours): self;
}
