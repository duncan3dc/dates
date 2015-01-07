<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;

/**
 * An iterator for the number of days in a range.
 */
class Days extends AbstractIterator
{
    /**
     * Create a new iterator for the number of days in a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start->midday();
        $this->end = $end->midday();
        $this->rewind();
    }


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    protected function increment()
    {
        $this->date = new DateTime(mktime(12, 0, 0, $this->date->numeric("n"), $this->date->numeric("j") + 1, $this->date->numeric("Y")));
    }
}
