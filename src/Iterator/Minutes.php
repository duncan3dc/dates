<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * An iterator for the number of minutes in a range.
 * @extends AbstractIterator<DateTimeInterface>
 */
final class Minutes extends AbstractIterator
{
    /**
     * Create a new iterator for the number of minutes in a range.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    public function __construct(DateTimeInterface $start, DateTimeInterface $end)
    {
        $this->start = $start->withSeconds(0)->timestamp();
        $this->end = $end->withSeconds(0)->timestamp();
        $this->rewind();
    }


    /**
     * Get the current iterator value.
     */
    public function current(): DateTimeInterface
    {
        return $this->date;
    }


    /**
     * Increment the internal date to the next position in the range.
     */
    protected function increment(): void
    {
        $this->date = $this->date->addMinutes(1);
    }
}
