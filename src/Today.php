<?php

namespace Regatta\Dates;

/**
 * A DateTime object representing today.
 */
class Today extends Date
{
    /**
     * Create a new instance.
     */
    public function __construct()
    {
        parent::__construct(time());
    }
}
