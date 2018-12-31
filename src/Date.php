<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * The date only portion of a DateTime object.
 */
class Date extends DateTime
{
    /**
     * @inheritdoc
     */
    public static function parse($date, $time = null): DateTimeInterface
    {
        $parser = new DateParser();

        $parser->addDefaultParsers();

        return $parser->parse($date);
    }


    /**
     * Create a new DateTime object from a set of individual parts.
     *
     * @param int $year The year
     * @param int $month The month
     * @param int $day The day
     *
     * @return static
     */
    public static function mkdate($year, $month, $day): Date
    {
        $unix = mktime(12, 0, 0, $month, $day, $year);

        return new static($unix);
    }


    /**
     * @inheritdoc
     */
    public function __construct(int $unix)
    {
        parent::__construct($unix);

        $this->unix = $this->midday();
    }
}
