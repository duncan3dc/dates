<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;

/**
 * An abstract class for creating iterators from a range of dates.
 */
abstract class AbstractIterator implements \Iterator, \Countable
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
     * @var int|null $count The number of elements in the iterator
     */
    protected $count;

    /**
     * Create a new iterator for a range.
     *
     * @param DateTime $start The start date of the range
     * @param DateTime $end The end date of the range
     */
    abstract public function __construct(DateTime $start, DateTime $end);


    /**
     * Increment the internal date to the next position in the range.
     *
     * @return void
     */
    abstract protected function increment();


    /**
     * Get the current iterator value.
     *
     * @return DateTime
     */
    public function current()
    {
        return $this->date;
    }


    /**
     * Get the current iterator position.
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }


    /**
     * Advance the iterator to the next position.
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
        $this->increment();
    }


    /**
     * Reset the iterator to the start.
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
        $this->date = new DateTime($this->start);
    }


    /**
     * Check if the current position is valid.
     *
     * @return bool
     */
    public function valid()
    {
        return $this->date->timestamp() <= $this->end;
    }


    /**
     * Get the number of elements in the iterator.
     *
     * @return int
     */
    public function count()
    {
        if ($this->count === null) {
            $this->count = count(iterator_to_array($this));
        }

        return $this->count;
    }
}
