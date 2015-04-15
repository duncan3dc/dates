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
     * @return static
     */
    public static function now()
    {
        return new static(Date::now());
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     *
     * @return static
     */
    public function addMonths($months)
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
     * @return static
     */
    public function subMonths($months)
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     *
     * @return static
     */
    public function addYears($years)
    {
        return $this->addMonths($years * 12);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     *
     * @return static
     */
    public function subYears($years)
    {
        return $this->addYears($years * -1);
    }
}
