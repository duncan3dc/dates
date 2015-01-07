<?php

namespace Regatta\Dates;

/**
 * A DateTime object representing the current time.
 */
class Now extends DateTime
{
    /**
     * Create a new instance.
     */
    public function __construct()
    {
        parent::__construct(time());
    }
}
