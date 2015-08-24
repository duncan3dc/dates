<?php

namespace Regatta\Dates\Iterator;

use Regatta\Dates\DateTime;
use Regatta\Dates\FinancialYear;

/**
 * An iterator for the number of financial years in a range.
 */
class FinancialYears extends AbstractIterator
{
    /**
     * Create a new iterator for the number of financial years in a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    public function __construct(DateTime $start, DateTime $end)
    {
        $this->start = FinancialYear::fromInt($start->getFinancialYear())->getStart()->timestamp();
        $this->end = FinancialYear::fromInt($end->getFinancialYear())->getStart()->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value.
     *
     * @return FinancialYear
     */
    public function current()
    {
        return new FinancialYear($this->date);
    }


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    protected function increment()
    {
        $this->date = $this->date->addYears(1);
    }
}
