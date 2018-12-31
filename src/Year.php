<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\YearInterface;

/**
 * A representation of a year.
 */
final class Year extends Range implements YearInterface
{
    use Traits\Formatting;


    /**
     * Get an instance for the current year.
     */
    public static function now(): YearInterface
    {
        return new self(Date::now());
    }


    public static function fromInt(int $year): YearInterface
    {
        $date = Date::mkdate($year, 1, 1);
        return new Year($date);
    }


    public function __construct(DateTimeInterface $date)
    {
        $this->unix = $date->timestamp();

        $start = Date::mkdate($date->numeric("Y"), 1, 1);
        $end = Date::mkdate($date->numeric("Y"), 12, 31);
        parent::__construct($start, $end);
    }


    /**
     * Get a new Range object for the specified number of months difference.
     *
     * @param int $months The number of months to add
     */
    public function addMonths(int $months): YearInterface
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
    public function subMonths(int $months): YearInterface
    {
        return $this->addMonths($months * -1);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to add
     */
    public function addYears(int $years): YearInterface
    {
        return $this->addMonths($years * 12);
    }


    /**
     * Get a new Range object for the specified number of years difference.
     *
     * @param int $years The number of years to subtract
     */
    public function subYears(int $years): YearInterface
    {
        return $this->addYears($years * -1);
    }
}
