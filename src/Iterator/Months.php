<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;

/**
 * An iterator for the number of months in a range.
 */
class Months extends AbstractIterator
{
    /**
     * Create a new iterator for the number of months in a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = mktime(12, 0, 0, $start->numeric("n"), 1, $start->numeric("Y"));
        $this->end = mktime(12, 0, 0, $end->numeric("n"), 1, $end->numeric("Y"));
        $this->rewind();
    }


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    protected function increment()
    {
        $this->date = new DateTime(mktime(12, 0, 0, $this->date->numeric("n") + 1, 1, $this->date->numeric("Y")));
    }
}
