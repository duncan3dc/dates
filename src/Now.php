<?php

namespace Regatta\Dates;

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
