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
     *
     * @return self
     */
    public static function now(): self
    {
        return new static(Date::now());
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return self
     */
    public function addMonths(int $months): self
    {
        $date = $this->getStart();
        $date = $date->addMonths($months);
        return new static($date);
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     *
     * @return self
     */
    public function subMonths(int $months): self
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return self
     */
    public function addYears(int $years): self
    {
        return $this->addMonths($years * 12);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     *
     * @return self
     */
    public function subYears(int $years): self
    {
        return $this->addYears($years * -1);
    }
}
