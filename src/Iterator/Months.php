<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Month;

/**
 * An iterator for the number of months in a range.
 */
final class Months extends AbstractIterator
{
    /**
     * Create a new iterator for the number of months in a range.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->start = $start->getMonth()->getStart()->timestamp();
        $this->end = $end->getMonth()->getStart()->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value.
     */
    public function current(): Month
    {
        return new Month($this->date);
    }


    /**
     * Increment the internal date to the next position in the range.
     */
    protected function increment(): void
    {
        $this->date = $this->date->addMonths(1);
    }
}
