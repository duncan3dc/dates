<?php

namespace duncan3dc\Dates\Traits;

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
    public function addDays(int $days): static
    {
        $days = (int) $days;
        if ($days === 0) {
            return $this;
        }

        return new static(mktime(
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
    public function subDays(int $days): static
    {
        return $this->addDays($days * -1);
    }


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     */
    public function addWeeks(int $weeks): static
    {
        $weeks = (int) $weeks;
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
    public function subWeeks(int $weeks): static
    {
        return $this->addWeeks($weeks * -1);
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): static
    {
        $months = (int) $months;
        if ($months === 0) {
            return $this;
        }

        $date = new static(mktime(
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

        return new static(mktime(
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
    public function subMonths(int $months): static
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): static
    {
        # Use addMonths to take advantage of the day wrapping handling, as years always have 12 months
        return $this->addMonths($years * 12);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): static
    {
        return $this->addYears($years * -1);
    }


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     */
    public function addSeconds(int $seconds): static
    {
        $seconds = (int) $seconds;
        if ($seconds === 0) {
            return $this;
        }

        return new static(mktime(
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
    public function subSeconds(int $seconds): static
    {
        return $this->addSeconds($seconds * -1);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     */
    public function addMinutes(int $minutes): static
    {
        return $this->addSeconds($minutes * 60);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     */
    public function subMinutes(int $minutes): static
    {
        return $this->addMinutes($minutes * -1);
    }

    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     */
    public function addHours(int $hours): static
    {
        return $this->addMinutes($hours * 60);
    }


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     */
    public function subHours(int $hours): static
    {
        return $this->addHours($hours * -1);
    }
}
