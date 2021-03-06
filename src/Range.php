<?php

namespace duncan3dc\Dates;

/**
 * A representation of a range of dates.
 */
class Range
{
    /**
     * @var DateTime $start The start date of this range.
     */
    protected $start;

    /**
     * @var DateTime $end The end date of this range.
     */
    protected $end;

    /**
     * Create a new range from 2 dates.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start;
        $this->end = $end;

        if ($this->end->timestamp() < $this->start->timestamp()) {
            throw new \InvalidArgumentException("Invalid range, the start date must be before the end date");
        }
    }


    /**
     * Get the start date of this range.
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }


    /**
     * Get the end date of this range.
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }


    /**
     * Get an iterator for the days covered by this date range.
     *
     * @return Iterator\Days
     */
    public function days()
    {
        return new Iterator\Days($this->start, $this->end);
    }


    /**
     * Get an iterator for the months covered by this date range.
     *
     * @return Iterator\Months
     */
    public function months()
    {
        return new Iterator\Months($this->start, $this->end);
    }


    /**
     * Get an iterator for the years covered by this date range.
     *
     * @return Iterator\Years
     */
    public function years()
    {
        return new Iterator\Years($this->start, $this->end);
    }


    /**
     * Get an iterator for the hours covered by this date range.
     *
     * @return Iterator\Hours
     */
    public function hours()
    {
        return new Iterator\Hours($this->start, $this->end);
    }


    /**
     * Get an iterator for the minutes covered by this date range.
     *
     * @return Iterator\Minutes
     */
    public function minutes()
    {
        return new Iterator\Minutes($this->start, $this->end);
    }


    /**
     * Get an iterator for the seconds covered by this date range.
     *
     * @return Iterator\Seconds
     */
    public function seconds()
    {
        return new Iterator\Seconds($this->start, $this->end);
    }


    /**
     * Get the range represented in a human readable format.
     *
     * @return string
     */
    public function asString()
    {
        $plural = function ($number, $word) {
            $number = (int) $number;
            if ($number !== 1) {
                $word .= "s";
            }
            return "{$number} {$word}";
        };

        $seconds = $this->end->timestamp() - $this->start->timestamp();

        if ($seconds < 60) {
            return $plural($seconds, "second");
        }

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        if ($minutes < 60) {
            if ($seconds >= 30) {
                ++$minutes;
            }
            return $plural($minutes, "minute");
        }

        $hours = floor($minutes / 60);
        $minutes %= 60;

        if ($hours < 24) {
            if ($minutes >= 30) {
                $hours++;
            }
            return $plural($hours, "hour");
        }

        $days = floor($hours / 24);
        $hours %= 24;

        if ($days < 7) {
            if ($hours >= 12) {
                ++$days;
            }
            return $plural($days, "day");
        }

        $weeks = floor($days / 7);
        $days %= 7;

        if ($weeks < 4) {
            if ($days > 3) {
                ++$weeks;
            }
            return $plural($weeks, "week");
        }

        $months = floor($weeks / 4);
        $weeks %= 4;

        if ($months < 12) {
            if ($weeks > 1.9) {
                ++$months;
            }
            return $plural($months, "month");
        }

        $years = floor($months / 12);
        $months %= 12;

        if ($months > 6) {
            ++$years;
        }
        return $plural($years, "year");
    }
}
