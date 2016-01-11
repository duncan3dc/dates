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
     *
     * @return self
     */
    public function addDays(int $days): self
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
     *
     * @return self
     */
    public function subDays(int $days): self
    {
        return $this->addDays($days * -1);
    }


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     *
     * @return self
     */
    public function addWeeks(int $weeks): self
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
     *
     * @return self
     */
    public function subWeeks(int $weeks): self
    {
        return $this->addWeeks($weeks * -1);
    }


    /**
     * Get a DateTime object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return self
     */
    public function addMonths(int $months): self
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
     *
     * @return self
     */
    public function subMonths(int $months): self
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return self
     */
    public function addYears(int $years): self
    {
        # Use addMonths to take advantage of the day wrapping handling, as years always have 12 months
        return $this->addMonths($years * 12);
    }


    /**
     * Get a DateTime object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     *
     * @return self
     */
    public function subYears(int $years): self
    {
        return $this->addYears($years * -1);
    }


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     *
     * @return self
     */
    public function addSeconds(int $seconds): self
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
     *
     * @return self
     */
    public function subSeconds(int $seconds): self
    {
        return $this->addSeconds($seconds * -1);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     *
     * @return self
     */
    public function addMinutes(int $minutes): self
    {
        return $this->addSeconds($minutes * 60);
    }


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     *
     * @return self
     */
    public function subMinutes(int $minutes): self
    {
        return $this->addMinutes($minutes * -1);
    }

    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     *
     * @return self
     */
    public function addHours(int $hours): self
    {
        return $this->addMinutes($hours * 60);
    }


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     *
     * @return self
     */
    public function subHours(int $hours): self
    {
        return $this->addHours($hours * -1);
    }
}
