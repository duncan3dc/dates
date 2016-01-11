<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * Common functionality applied to ranges that are constrained in some way (eg, month, year, etc)
 */
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
     * @return Iterator\Days
     */
    public function days(): IteratorInterface;


    /**
     * Get an iterator for the months covered by this date range.
     *
     * @return Iterator\Months
     */
    public function months(): IteratorInterface;


    /**
     * Get an iterator for the years covered by this date range.
     *
     * @return Iterator\Years
     */
    public function years(): IteratorInterface;

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
