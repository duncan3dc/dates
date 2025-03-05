<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * A representation of a month.
 */
interface MonthInterface extends RangeInterface, FormatInterface
{
    public static function now(): MonthInterface;


    /**
     * Get a new Range object for the specified number of months difference.
     */
    public function addMonths(int $months): MonthInterface;


    /**
     * Get a new Range object for the specified number of months difference.
     */
    public function subMonths(int $months): MonthInterface;


    /**
     * Get a new Range object for the specified number of years difference.
     */
    public function addYears(int $years): MonthInterface;


    /**
     * Get a new Range object for the specified number of years difference.
     */
    public function subYears(int $years): MonthInterface;
}
