<?php

namespace duncan3dc\Dates\Interfaces;

use duncan3dc\Dates\Month;
use duncan3dc\Dates\Year;

interface RangeInterface
{
    /**
     * Get the start date of this range.
     *
     * @return DateTimeInterface
     */
    public function getStart(): DateTimeInterface;


    /**
     * Get the end date of this range.
     *
     * @return DateTimeInterface
     */
    public function getEnd(): DateTimeInterface;


    /**
     * Get an iterator for the days covered by this date range.
     *
     * @return IteratorInterface&DateTimeInterface[]
     */
    public function days(): IteratorInterface;


    /**
     * Get an iterator for the months covered by this date range.
     *
     * @return IteratorInterface&Month[]
     */
    public function months(): IteratorInterface;


    /**
     * Get an iterator for the years covered by this date range.
     *
     * @return IteratorInterface&Year[]
     */
    public function years(): IteratorInterface;


    /**
     * Get an iterator for the hours covered by this date range.
     *
     * @return IteratorInterface&DateTimeInterface[]
     */
    public function hours(): IteratorInterface;


    /**
     * Get an iterator for the minutes covered by this date range.
     *
     * @return IteratorInterface&DateTimeInterface[]
     */
    public function minutes(): IteratorInterface;


    /**
     * Get an iterator for the seconds covered by this date range.
     *
     * @return IteratorInterface&DateTimeInterface[]
     */
    public function seconds(): IteratorInterface;


    /**
     * Get the range represented in a human readable format.
     *
     * @return string
     */
    public function asString(): string;

# TODO - Separate interface?

    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return static
     */
#    public function addMonths(int $months): self;


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     *
     * @return static
     */
#    public function subMonths(int $months): self;


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return static
     */
#    public function addYears(int $years): self;


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     *
     * @return static
     */
#    public function subYears(int $years): self;
}
