<?php

namespace Regatta\Dates;

/**
 * The date only portion of a DateTime object.
 */
class Date extends DateTime
{
    /**
     * Create a new instance from a unix timestamp
     *
     * @param int A unix timestamp
     */
    public function __construct($unix)
    {
        parent::__construct($unix);

        $this->unix = $this->midday();
    }
}
