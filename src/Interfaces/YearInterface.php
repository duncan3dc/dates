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
}
