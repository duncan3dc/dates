<?php

namespace duncan3dc\Dates\Interfaces;

interface RangeInterface
{
    /**
     * Get the start date of this range.
     */
    public function getStart(): DateTimeInterface;


    /**
     * Get the end date of this range.
     */
    public function getEnd(): DateTimeInterface;


    /**
     * Get an iterator for the days covered by this date range.
     *
     * @return IteratorInterface<DateTimeInterface>
     */
    public function days(): IteratorInterface;


    /**
     * Get an iterator for the months covered by this date range.
     *
     * @return IteratorInterface<MonthInterface>
     */
    public function months(): IteratorInterface;


    /**
     * Get an iterator for the years covered by this date range.
     *
     * @return IteratorInterface<YearInterface>
     */
    public function years(): IteratorInterface;


    /**
     * Get an iterator for the hours covered by this date range.
     *
     * @return IteratorInterface<DateTimeInterface>
     */
    public function hours(): IteratorInterface;


    /**
     * Get an iterator for the minutes covered by this date range.
     *
     * @return IteratorInterface<DateTimeInterface>
     */
    public function minutes(): IteratorInterface;


    /**
     * Get an iterator for the seconds covered by this date range.
     *
     * @return IteratorInterface<DateTimeInterface>
     */
    public function seconds(): IteratorInterface;


    /**
     * Get the range represented in a human readable format.
     */
    public function asString(): string;

# TODO - Separate interface?

    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
#    public function addMonths(int $months): static;


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     */
#    public function subMonths(int $months): static;


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
#    public function addYears(int $years): static;


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
#    public function subYears(int $years): static;
}
