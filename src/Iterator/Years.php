<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\YearInterface;
use duncan3dc\Dates\Year;

/**
 * An iterator for the number of years in a range.
 */
final class Years extends AbstractIterator
{
    /**
     * Create a new iterator for the number of years in a range.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->start = $start->getYear()->getStart()->timestamp();
        $this->end = $end->getYear()->getStart()->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value.
     */
    public function current(): Year
    {
        return new Year($this->date);
    }


    /**
     * Increment the internal date to the next position in the range.
     */
    protected function increment(): void
    {
        $this->date = $this->date->addYears(1);
    }
}
