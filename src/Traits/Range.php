<?php

namespace duncan3dc\Dates\Traits;

use duncan3dc\Dates\Date;

/**
 * Common functionality applied to ranges that are constrained in some way (eg, month, year, etc)
 */
trait Range
{
    /**
     * Create a new range object representing the current date.
     */
    public static function now(): static
    {
        return new static(Date::now());
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): static
    {
        $date = $this->getStart();
        $date = $date->addMonths($months);
        return new static($date);
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     */
    public function subMonths(int $months): static
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): static
    {
        return $this->addMonths($years * 12);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): static
    {
        return $this->addYears($years * -1);
    }
}
