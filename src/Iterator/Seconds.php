<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * An iterator for the number of seconds in a range.
 */
final class Seconds extends AbstractIterator
{
    /**
     * Create a new iterator for the number of seconds in a range.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->start = $start->timestamp();
        $this->end = $end->timestamp();
        $this->rewind();
    }


    /**
     * Increment the internal date to the next position in the range.
     */
    protected function increment(): void
    {
        $this->date = $this->date->addSeconds(1);
    }
}
