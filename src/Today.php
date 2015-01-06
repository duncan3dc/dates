<?php

namespace Regatta\Dates;

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
