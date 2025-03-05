<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Helpers\Formatter;
use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\MonthInterface;

/**
 * A representation of a month.
 */
final class Month extends Range implements MonthInterface
{
    private int $timestamp;


    /**
     * Get an instance for the current month.
     */
    public static function now(): MonthInterface
    {
        return new self(Date::now());
    }


    public function __construct(DateTimeInterface $date)
    {
        $this->timestamp = $date->timestamp();

        $start = Date::mkdate($date->numeric("Y"), $date->numeric("n"), 1);
        $end = Date::mkdate($date->numeric("Y"), $date->numeric("n"), $date->numeric("t"));
        parent::__construct($start, $end);
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
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): MonthInterface
    {
        $date = $this->getStart();
        $date = $date->addMonths($months);
        return new self($date);
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to subtract
     */
    public function subMonths(int $months): MonthInterface
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): MonthInterface
    {
        return $this->addMonths($years * 12);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): MonthInterface
    {
        return $this->addYears($years * -1);
    }
}
