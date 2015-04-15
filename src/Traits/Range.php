<?php

namespace Regatta\Dates\Traits;

use Regatta\Dates\Date;

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
}
