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
}
