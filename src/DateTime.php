<?php

namespace Regatta\Dates;

class DateTime
{
    /**
     * @var int $date Unix timestamp representing the datetime of this object
     */
    protected $unix;

    /**
     * Create a new instance from a unix timestamp
     *
     * @param int A unix timestamp
     */
    public function __construct($unix = null)
    {
        if ($unix === null) {
            $unix = time();
        }
        if (!$unix = (int) $unix) {
            throw new \InvalidArgumentException("An invalid unix timestamp was passed");
        }

        $this->unix = $unix;
    }


    /**
     * Get the datetime as a unix timestamp.
     *
     * @return int
     */
    public function asUnix()
    {
        return $this->unix;
    }
}
