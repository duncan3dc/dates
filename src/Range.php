<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\IteratorInterface;
use duncan3dc\Dates\Interfaces\RangeInterface;

/**
 * A representation of a range of dates.
 */
class Range implements RangeInterface
{
    protected DateTimeInterface $start;

    protected DateTimeInterface $end;


    /**
     * Create a new range from 2 dates.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->start = $start;
        $this->end = $end;

        if ($this->end->timestamp() < $this->start->timestamp()) {
            throw new \InvalidArgumentException("Invalid range, the start date must be before the end date");
        }
    }


    public function getStart(): DateTimeInterface
    {
        return $this->start;
    }


    public function getEnd(): DateTimeInterface
    {
        return $this->end;
    }


    public function days(): IteratorInterface
    {
        return new Iterator\Days($this->start, $this->end);
    }


    public function months(): IteratorInterface
    {
        return new Iterator\Months($this->start, $this->end);
    }


    public function years(): IteratorInterface
    {
        return new Iterator\Years($this->start, $this->end);
    }


    public function hours(): IteratorInterface
    {
        return new Iterator\Hours($this->start, $this->end);
    }


    public function minutes(): IteratorInterface
    {
        return new Iterator\Minutes($this->start, $this->end);
    }


    public function seconds(): IteratorInterface
    {
        return new Iterator\Seconds($this->start, $this->end);
    }


    public function asString(): string
    {
        $plural = function (int|float $number, string $word) {
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
