<?php

namespace duncan3dc\Dates;

/**
 * A class to respresent a unix timestamp and allow convenient methods.
 */
class DateTime
{
    use Traits\BankHoliday;
    use Traits\DayHelpers;
    use Traits\Formatting;
    use Traits\RelativeDateTimes;

    /**
     * Create a new DateTime object representing the current time.
     *
     * @return static
     */
    public static function now()
    {
        return new static(time());
    }


    /**
     * Create a new DateTime object from a parsable date/time.
     *
     * @param string|int $date The date to parse
     * @param string|int $time The time to parse
     *
     * @return static
     */
    public static function parse($date, $time = null)
    {
        $parser = new DateTimeParser();

        $parser->addDefaultParsers();

        return $parser->parse($date, $time);
    }


    /**
     * Create a new DateTime object from a specifically formatted date/time.
     *
     * @param string $format The format that the date/time is in
     * @param string $date The date/time to parse
     *
     * @return static
     */
    public static function fromFormat($format, $date)
    {
        # A couple of hacks to work around lack of support for single digit elements
        if ($format === "Gis") {
            $format = "His";
            $date = sprintf("%06s", $date);
        }
        if (substr($format, -4) === " Gis") {
            $format = substr($format, 0, -3) . "His";
            $date = preg_replace("/ ([0-9]{5})$/", " 0$1", $date);
        }

        $datetime = \DateTime::createFromFormat($format, $date);

        if ($datetime === false) {
            throw new \InvalidArgumentException("Invalid date ({$date}) does not conform to format ({$format})");
        }

        $unix = $datetime->getTimestamp();

        return new static($unix);
    }


    /**
     * Create a new DateTime object from a set of individual parts.
     *
     * @param int $hour The hour
     * @param int $minute The minute
     * @param int $second The second
     * @param int $month The month
     * @param int $day The day
     * @param int $year The year
     *
     * @return static
     */
    public static function mktime($hour, $minute, $second, $month, $day, $year)
    {
        $unix = mktime($hour, $minute, $second, $month, $day, $year);

        return new static($unix);
    }


    /**
     * Create a new instance from a unix timestamp.
     *
     * @param int A unix timestamp
     */
    public function __construct($unix)
    {
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
    public function timestamp()
    {
        return $this->unix;
    }


    /**
     * Get a Month object for this date.
     *
     * @return Month
     */
    public function getMonth()
    {
        return new Month($this);
    }


    /**
     * Get a Year object for this date.
     *
     * @return Year
     */
    public function getYear()
    {
        return new Year($this);
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


    /**
     * Get a unix timestamp for the start of this date.
     *
     * @return int
     */
    public function start()
    {
        return mktime(0, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a unix timestamp for the end of this date.
     *
     * @return int
     */
    public function end()
    {
        return mktime(23, 59, 59, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a new instance but with the specified year.
     *
     * @param int $year The year to use
     *
     * @return static
     */
    public function withYear($year)
    {
        $year = (int) $year;

        # Use addYears() to handle the variable number of days in each month
        $years = $year - $this->numeric("Y");
        return $this->addyears($years);
    }


    /**
     * Get a new instance but with the specified month.
     *
     * @param int $month The month to use
     *
     * @return static
     */
    public function withMonth($month)
    {
        $month = (int) $month;

        # Use addMonths() to handle the variable number of days in each month
        $months = $month - $this->numeric("n");
        return $this->addMonths($months);
    }


    /**
     * Get a new instance but with the specified day.
     *
     * @param int $day The day to use
     *
     * @return static
     */
    public function withDay($day)
    {
        $day = (int) $day;

        $max = $this->numeric("t");
        if ($day > $max) {
            throw new \UnexpectedValueException("Unable to set the day to {$day} as this month only has {$max} days, use withMonth() first");
        }

        $date = static::mktime($this->numeric("H"), $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $day, $this->numeric("Y"));

        if ($date->numeric("j") !== $day) {
            throw new \RunetimeException("Unable to change the day of " . $this->string("Y-m-d H:i:s") . "to {$day}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified hour.
     *
     * @param int $hour The hour to use
     *
     * @return DateTime
     */
    public function withHours($hour)
    {
        $hour = (int) $hour;

        $date = DateTime::mktime($hour, $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("G") !== $hour) {
            throw new \RunetimeException("Unable to change the hour of " . $this->string("Y-m-d H:i:s") . "to {$hour}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified minute.
     *
     * @param int $minute The minute to use
     *
     * @return DateTime
     */
    public function withMinutes($minute)
    {
        $minute = (int) $minute;

        $date = DateTime::mktime($this->numeric("G"), $minute, $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("i") !== $minute) {
            throw new \RunetimeException("Unable to change the minute of " . $this->string("Y-m-d H:i:s") . "to {$minute}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified second.
     *
     * @param int $second The second to use
     *
     * @return static
     */
    public function withSeconds($second)
    {
        $second = (int) $second;

        $date = DateTime::mktime($this->numeric("G"), $this->numeric("i"), $second, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("s") !== $second) {
            throw new \RunetimeException("Unable to change the second of " . $this->string("Y-m-d H:i:s") . "to {$second}");
        }

        return $date;
    }
}
