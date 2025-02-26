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
     */
    public static function now(): static
    {
        return new static(time());
    }


    /**
     * Create a new DateTime object from a parsable date/time.
     *
     * @param string|int $date The date to parse
     * @param string|int $time The time to parse
     */
    public static function parse(string|int $date, string|int|null $time = null): static
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
     */
    public static function fromFormat(string $format, string $date): static
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
     */
    public static function mktime(int $hour, int $minute, int $second, int $month, int $day, int $year): static
    {
        $unix = mktime($hour, $minute, $second, $month, $day, $year);

        return new static($unix);
    }


    /**
     * Convert a free format date to an instance.
     *
     * @param string $date The date to parse
     */
    public static function strtotime(string $date): static
    {
        $unix = strtotime($date);

        return new static($unix);
    }


    /**
     * Create a new instance from a unix timestamp.
     *
     * @param int A unix timestamp
     */
    public function __construct(int $unix)
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
    public function timestamp(): int
    {
        return $this->unix;
    }


    /**
     * Get a Month object for this date.
     */
    public function getMonth(): Month
    {
        return new Month($this);
    }


    /**
     * Get a Year object for this date.
     */
    public function getYear(): Year
    {
        return new Year($this);
    }


    /**
     * Get a unix timestamp for 12pm on this date.
     */
    public function midday(): int
    {
        return mktime(12, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a unix timestamp for the start of this date.
     */
    public function start(): int
    {
        return mktime(0, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a unix timestamp for the end of this date.
     */
    public function end(): int
    {
        return mktime(23, 59, 59, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a new instance but with the specified year.
     *
     * @param int $year The year to use
     */
    public function withYear(int $year): static
    {
        # Use addYears() to handle the variable number of days in each month
        $years = $year - $this->numeric("Y");
        return $this->addyears($years);
    }


    /**
     * Get a new instance but with the specified month.
     *
     * @param int $month The month to use
     */
    public function withMonth(int $month): static
    {
        # Use addMonths() to handle the variable number of days in each month
        $months = $month - $this->numeric("n");
        return $this->addMonths($months);
    }


    /**
     * Get a new instance but with the specified day.
     *
     * @param int $day The day to use
     */
    public function withDay(int $day): static
    {
        $max = $this->numeric("t");
        if ($day > $max) {
            throw new \UnexpectedValueException("Unable to set the day to {$day} as this month only has {$max} days, use withMonth() first");
        }

        $date = static::mktime($this->numeric("H"), $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $day, $this->numeric("Y"));

        if ($date->numeric("j") !== $day) {
            throw new \RuntimeException("Unable to change the day of " . $this->string("Y-m-d H:i:s") . "to {$day}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified hour.
     *
     * @param int $hour The hour to use
     */
    public function withHours(int $hour): DateTime
    {
        $date = DateTime::mktime($hour, $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("G") !== $hour) {
            throw new \RuntimeException("Unable to change the hour of " . $this->string("Y-m-d H:i:s") . "to {$hour}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified minute.
     *
     * @param int $minute The minute to use
     */
    public function withMinutes(int $minute): DateTime
    {
        $date = DateTime::mktime($this->numeric("G"), $minute, $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("i") !== $minute) {
            throw new \RuntimeException("Unable to change the minute of " . $this->string("Y-m-d H:i:s") . "to {$minute}");
        }

        return $date;
    }


    /**
     * Get a new instance but with the specified second.
     *
     * @param int $second The second to use
     */
    public function withSeconds(int $second): DateTime
    {
        $date = DateTime::mktime($this->numeric("G"), $this->numeric("i"), $second, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("s") !== $second) {
            throw new \RuntimeException("Unable to change the second of " . $this->string("Y-m-d H:i:s") . "to {$second}");
        }

        return $date;
    }
}
