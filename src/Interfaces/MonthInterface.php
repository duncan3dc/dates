<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * A representation of a month.
 */
interface MonthInterface extends RangeInterface, FormatInterface
{
    public static function now(): MonthInterface;
}
