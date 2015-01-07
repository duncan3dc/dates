<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;

/**
 * An iterator for the number of days in a range.
 */
class Days implements \Iterator
{
    /**
     * @var int $start The unix timestamp for the start date of the range
     */
    protected $start;

    /**
     * @var int $end The unix timestamp for the end date of the range
     */
    protected $end;

    /**
     * @var int $position The current position in the iterator
     */
    protected $position;

    /**
     * @var DateTime $date The date object for the current iterator position
     */
    protected $date;


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
     * Get the current iterator value
     *
     * @return DateTime
     */
    public function current()
    {
        return $this->date;
    }


    /**
     * Get the current iterator position
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }


    /**
     * Advance the iterator to the next position
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
        $this->date = new DateTime(mktime(12, 0, 0, $this->date->numeric("n"), $this->date->numeric("j") + 1, $this->date->numeric("Y")));
    }


    /**
     * Reset the iterator to the start
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
        $this->date = new DateTime($this->start);
    }


    /**
     * Check if the current position is valid
     *
     * @return boolean
     */
    public function valid()
    {
        return $this->date->midday() <= $this->end;
    }
}
