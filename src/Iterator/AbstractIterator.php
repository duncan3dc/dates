<?php

namespace duncan3dc\Dates\Iterator;

use duncan3dc\Dates\DateTime;
use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\IteratorInterface;

/**
 * An abstract class for creating iterators from a range of dates.
 * @template T of object
 * @implements IteratorInterface<T>
 */
abstract class AbstractIterator implements IteratorInterface
{
    /**
     * @var int $start The unix timestamp for the start date of the range
     */
    protected int $start;

    /**
     * @var int $end The unix timestamp for the end date of the range
     */
    protected int $end;

    /**
     * @var int $position The current position in the iterator
     */
    protected int $position;

    /**
     * @var DateTimeInterface $date The date object for the current iterator position
     */
    protected DateTimeInterface $date;

    /**
     * @var int<0, max>|null $count The number of elements in the iterator
     */
    protected ?int $count = null;

    /**
     * Create a new iterator for a range.
     *
     * @param DateTimeInterface $start The start date of the range
     * @param DateTimeInterface $end The end date of the range
     */
    abstract public function __construct(DateTimeInterface $start, DateTimeInterface $end);


    /**
     * Increment the internal date to the next position in the range.
     */
    abstract protected function increment(): void;


    /**
     * Get the current iterator position.
     */
    public function key(): int
    {
        return $this->position;
    }


    /**
     * Advance the iterator to the next position.
     */
    public function next(): void
    {
        ++$this->position;
        $this->increment();
    }


    /**
     * Reset the iterator to the start.
     */
    public function rewind(): void
    {
        $this->position = 0;
        $this->date = new DateTime($this->start);
    }


    /**
     * Check if the current position is valid.
     */
    public function valid(): bool
    {
        return $this->date->timestamp() <= $this->end;
    }


    /**
     * Get the number of elements in the iterator.
     */
    public function count(): int
    {
        if ($this->count === null) {
            $this->count = count(iterator_to_array($this));
        }

        return $this->count;
    }
}
