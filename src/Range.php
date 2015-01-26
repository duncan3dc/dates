<?php

namespace duncan3dc\Dates;

/**
 * A representation of a range of dates.
 */
class Range
{
    /**
     * @var DateTime $start The start date of this range
     */
    protected $start;

    /**
     * @var DateTime $end The end date of this range
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
}
