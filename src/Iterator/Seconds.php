<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;

/**
 * An iterator for the number of seconds in a range.
 */
class Seconds extends AbstractIterator
{
    /**
     * Create a new iterator for the number of seconds in a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
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
