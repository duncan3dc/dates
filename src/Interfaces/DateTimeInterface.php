<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * A class to respresent a unix timestamp and allow convenient methods.
 */
interface DateTimeInterface extends DayInterface, FormatInterface, ModifyInterface
{

    /**
     * Get the datetime as a unix timestamp.
     *
     * @return int
     */
    public function timestamp(): int;


    /**
     * Get a Month object for this date.
     *
     * @return Month
     */
    public function getMonth(): MonthInterface;


    /**
     * Get a Year object for this date.
     *
     * @return Year
     */
    public function getYear(): YearInterface;


    /**
     * Get a unix timestamp for 12pm on this date.
     *
     * @return int
     */
    public function midday(): int;


    /**
     * Get a unix timestamp for the start of this date.
     *
     * @return int
     */
    public function start(): int;


    /**
     * Get a unix timestamp for the end of this date.
     *
     * @return int
     */
    public function end(): int;
}
