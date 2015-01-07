<?php

namespace Regatta\Dates;

/**
 * A class to respresent a unix timestamp and allow convenient methods.
 */
class DateTime
{
    /**
     * @var int $unix Unix timestamp representing the datetime of this object
     */
    protected $unix;

    /**
     * @var Date $period The financial period data for this date
     */
    protected $period;

    /**
     * Create a new instance from a unix timestamp
     *
     * @param int A unix timestamp
     */
    public function __construct($unix)
    {
        if (!$unix = (int) $unix) {
            throw new \InvalidArgumentException("An invalid unix timestamp was passed");
        }

        $this->unix = $unix;
        $this->period = null;
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


    /**
     * Get the details of the financial period for this date.
     *
     * @return Date
     */
    public function getPeriod()
    {
        if ($this->period === null) {
            $this->period = new Date(mktime(12, 0, 0, date("n", $this->unix) - 1, date("j", $this->unix), date("Y", $this->unix)));
        }

        return $this->period;
    }


    /**
     * Get the financial yaer of this date.
     *
     * @return int
     */
    public function getFinancialYear()
    {
        return $this->getPeriod()->numeric("Y");
    }


    /**
     * Get the financial yaer of this date.
     *
     * @return int
     */
    public function getFinancialPeriod()
    {
        return $this->getPeriod()->numeric("n");
    }


    /**
     * Format the date using the specified format.
     *
     * This method will convert the result to an integer if it looks like one.
     *
     * @var string $format The format to apply to the date
     *
     * @return string|int
     */
    public function format($format)
    {
        $return = $this->string($format);

        # If the result looks like a number then return it as an int
        if (preg_match("/^[0-9]+$/", $return)) {
            # Only attempt to cast a number in the range supported by this install
            if ($return < \PHP_INT_MAX) {
                $return = (int) $return;
            }
        }

        return $return;
    }


    /**
     * Format the date unsing the specified format and return a number.
     *
     * @var string $format The format to apply to the date
     *
     * @return int
     */
    public function numeric($format)
    {
        return (int) $this->string($format);
    }


    /**
     * Format the date unsing the specified format and return a string.
     *
     * @var string $format The format to apply to the date
     *
     * @return int
     */
    public function string($format)
    {
        return date($format, $this->unix);
    }


    /**
     * Get a unix timestamp for 12pm on this date.
     *
     * @return int
     */
    public function midday()
    {
        return mktime(12, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }
}
