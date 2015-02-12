<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\Season;

/**
 * An iterator for the number of years in a range.
 */
class Seasons extends AbstractIterator
{
    /**
     * Create a new iterator for the number of years in a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = $start->getSeason()->getStart()->timestamp();
        $this->end = $end->getSeason()->getStart()->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value
     *
     * @return Season
     */
    public function current()
    {
        return new Season($this->date);
    }


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    protected function increment()
    {
        $this->date = $this->date->addMonths(6);
    }
}
