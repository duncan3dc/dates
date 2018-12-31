<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * Get a new DateTime object relative to the current one.
 */
trait RelativeDateTimes
{
    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     */
    public function addDays(int $days): DateTimeInterface
    {
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
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to subtract
     */
    public function subDays(int $days): DateTimeInterface
    {
        return $this->addDays($days * -1);
    }


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     */
    public function addWeeks(int $weeks): DateTimeInterface
    {
        if ($weeks === 0) {
            return $this;
        }

        return $this->addDays($weeks * 7);
    }


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to subtract
     */
    public function subWeeks(int $weeks): DateTimeInterface
    {
        return $this->addWeeks($weeks * -1);
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): DateTimeInterface
    {
        if ($months === 0) {
            return $this;
        }

        $date = new DateTime(mktime(
            $this->numeric("H"),
            $this->numeric("i"),
            $this->numeric("s"),
            $this->numeric("n") + $months,
            1,
            $this->numeric("Y")
        ));

        # Prevent the month from wrapping when using a date that doesn't exist in that month
        $day = $this->numeric("j");
        $max = $date->numeric("t");
        if ($day > $max) {
            $day = $max;
        }

        return new DateTime(mktime(
            $this->numeric("H"),
            $this->numeric("i"),
            $this->numeric("s"),
            $this->numeric("n") + $months,
            $day,
            $this->numeric("Y")
        ));
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     */
    public function subMonths(int $months): DateTimeInterface
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): DateTimeInterface
    {
        # Use addMonths to take advantage of the day wrapping handling, as years always have 12 months
        return $this->addMonths($years * 12);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): DateTimeInterface
    {
        return $this->addYears($years * -1);
    }


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     */
    public function addSeconds(int $seconds): DateTimeInterface
    {
        if ($seconds === 0) {
            return $this;
        }

        return new DateTime(mktime(
            $this->numeric("H"),
            $this->numeric("i"),
            $this->numeric("s") + $seconds,
            $this->numeric("n"),
            $this->numeric("j"),
            $this->numeric("Y")
        ));
    }


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to subtract
     */
    public function subSeconds(int $seconds): DateTimeInterface
    {
        return $this->addSeconds($seconds * -1);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     */
    public function addMinutes(int $minutes): DateTimeInterface
    {
        return $this->addSeconds($minutes * 60);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     */
    public function subMinutes(int $minutes): DateTimeInterface
    {
        return $this->addMinutes($minutes * -1);
    }

    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     */
    public function addHours(int $hours): DateTimeInterface
    {
        return $this->addMinutes($hours * 60);
    }


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     */
    public function subHours(int $hours): DateTimeInterface
    {
        return $this->addHours($hours * -1);
    }
}
