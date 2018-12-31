<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Helpers\BankHoliday;
use duncan3dc\Dates\Helpers\Formatter;
use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\MonthInterface;
use duncan3dc\Dates\Interfaces\YearInterface;

use function date;
use function preg_match;
use function time;

/**
 * A class to respresent a unix timestamp and allow convenient methods.
 */
final class DateTime implements DateTimeInterface
{
    use Traits\DayHelpers;
    use Traits\RelativeDateTimes;

    private int $timestamp;


    /**
     * Create a new DateTime object representing the current time.
     */
    public static function now(): DateTimeInterface
    {
        return new self(time());
    }


    /**
     * Create a new DateTime object from a parsable date/time.
     *
     * @param string|int $date The date to parse
     * @param string|int|null $time The time to parse
     */
    public static function parse(string|int $date, string|int|null $time = null): DateTimeInterface
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
    public static function fromFormat(string $format, string $date): DateTimeInterface
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

        $datetime = \DateTime::createFromFormat($format, (string) $date);

        if ($datetime === false) {
            throw new \InvalidArgumentException("Invalid date ({$date}) does not conform to format ({$format})");
        }

        $unix = $datetime->getTimestamp();

        return new self($unix);
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
    public static function mktime(int $hour, int $minute, int $second, int $month, int $day, int $year): DateTimeInterface
    {
        $unix = (int) mktime($hour, $minute, $second, $month, $day, $year);

        return new self($unix);
    }


    /**
     * Convert a free format date to an instance.
     *
     * @param string $date The date to parse
     */
    public static function strtotime(string $date): DateTimeInterface
    {
        $unix = (int) strtotime($date);

        return new self($unix);
    }


    /**
     * Create a new instance from a unix timestamp.
     */
    public function __construct(int $timestamp)
    {
        if (!$timestamp) {
            throw new \InvalidArgumentException("An invalid unix timestamp was passed");
        }

        $this->timestamp = $timestamp;
    }


    /**
     * Get the datetime as a unix timestamp.
     *
     * @return int
     */
    public function timestamp(): int
    {
        return $this->timestamp;
    }


    public function numeric(string $format): int
    {
        return Formatter::numeric($format, $this->timestamp);
    }


    public function string(string $format): string
    {
        return Formatter::string($format, $this->timestamp);
    }


    public function format(string $format): string|int
    {
        return Formatter::format($format, $this->timestamp);
    }


    /**
     * Get a Month object for this date.
     */
    public function getMonth(): MonthInterface
    {
        return new Month($this);
    }


    /**
     * Get a Year object for this date.
     */
    public function getYear(): YearInterface
    {
        return new Year($this);
    }


    /**
     * Get a unix timestamp for 12pm on this date.
     */
    public function midday(): int
    {
        return (int) mktime(12, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a unix timestamp for the start of this date.
     */
    public function start(): int
    {
        return (int) mktime(0, 0, 0, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    /**
     * Get a unix timestamp for the end of this date.
     */
    public function end(): int
    {
        return (int) mktime(23, 59, 59, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));
    }


    public function withYear(int $year): DateTimeInterface
    {
        # Use addYears() to handle the variable number of days in each month
        $years = $year - $this->numeric("Y");
        return $this->addyears($years);
    }


    public function withMonth(int $month): DateTimeInterface
    {
        # Use addMonths() to handle the variable number of days in each month
        $months = $month - $this->numeric("n");
        return $this->addMonths($months);
    }


    public function withDay(int $day): DateTimeInterface
    {
        $max = $this->numeric("t");
        if ($day > $max) {
            throw new \UnexpectedValueException("Unable to set the day to {$day} as this month only has {$max} days, use withMonth() first");
        }

        $date = self::mktime($this->numeric("H"), $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $day, $this->numeric("Y"));

        if ($date->numeric("j") !== $day) {
            throw new \RuntimeException("Unable to change the day of " . $this->string("Y-m-d H:i:s") . "to {$day}");
        }

        return $date;
    }


    public function withHours(int $hour): DateTimeInterface
    {
        $date = DateTime::mktime($hour, $this->numeric("i"), $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("G") !== $hour) {
            throw new \RuntimeException("Unable to change the hour of " . $this->string("Y-m-d H:i:s") . "to {$hour}");
        }

        return $date;
    }


    public function withMinutes(int $minute): DateTimeInterface
    {
        $date = DateTime::mktime($this->numeric("G"), $minute, $this->numeric("s"), $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("i") !== $minute) {
            throw new \RuntimeException("Unable to change the minute of " . $this->string("Y-m-d H:i:s") . "to {$minute}");
        }

        return $date;
    }


    public function withSeconds(int $second): DateTimeInterface
    {
        $date = DateTime::mktime($this->numeric("G"), $this->numeric("i"), $second, $this->numeric("n"), $this->numeric("j"), $this->numeric("Y"));

        if ($date->numeric("s") !== $second) {
            throw new \RuntimeException("Unable to change the second of " . $this->string("Y-m-d H:i:s") . "to {$second}");
        }

        return $date;
    }


    public function isBankHoliday(): bool
    {
        return BankHoliday::isBankHoliday($this);
    }
}
