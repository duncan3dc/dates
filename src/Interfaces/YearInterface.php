<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * A representation of a year.
 */
interface YearInterface extends RangeInterface, FormatInterface
{
    /**
     * Create a new instance of the Year class from a numeric 4 digit year.
     *
     * @param int $year The 4 digit year (eg 2015)
     */
    public static function fromInt(int $year): YearInterface;

    /**
     * Get a new Range object for the specified number of months difference.
     */
    public function addMonths(int $months): YearInterface;


    /**
     * Get a new Range object for the specified number of months difference.
     */
    public function subMonths(int $months): YearInterface;


    /**
     * Get a new Range object for the specified number of years difference.
     */
    public function addYears(int $years): YearInterface;


    /**
     * Get a new Range object for the specified number of years difference.
     */
    public function subYears(int $years): YearInterface;
}
