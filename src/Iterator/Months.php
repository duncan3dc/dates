<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\Month;

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
        $this->start = $start->getMonth()->getStart()->timestamp();
        $this->end = $end->getMonth()->getStart()->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value.
     *
     * @return Month
     */
    public function current()
    {
        return new Month($this->date);
    }


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    protected function increment()
    {
        $this->date = $this->date->addMonths(1);
    }
}
