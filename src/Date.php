<?php

namespace Regatta\Dates;

/**
 * The date only portion of a DateTime object.
 */
class Date extends DateTime
{
    /**
     * Parse dates in a variety of formats and create a Date object.
     *
     * @param string|int The date to parse
     * @param string|int The time to parse (ignored, use the DateTime class for time parsing)
     *
     * @return Date
     */
    public static function parse($date, $time = null)
    {
        $parser = new DateParser();

        $parser->addDefaultParsers();

        return $parser->parse($date);
    }


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
