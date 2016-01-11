<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * Get a new instance relative to the current one.
 */
interface ModifyInterface extends RangeInterface
{
    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to add
     *
     * @return self
     */
    public function addDays(int $days): self;


    /**
     * Get a DateTime object for the specified number of days difference.
     *
     * @param int $days The number of days to subtract
     *
     * @return self
     */
    public function subDays(int $days): self;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to add
     *
     * @return self
     */
    public function addWeeks(int $weeks): self;


    /**
     * Get a DateTime object for the specified number of weeks difference.
     *
     * @param int $weeks The number of weeks to subtract
     *
     * @return self
     */
    public function subWeeks(int $weeks): self;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to add
     *
     * @return self
     */
    public function addSeconds(int $seconds): self;


    /**
     * Get a DateTime object for the specified number of seconds difference.
     *
     * @param int $seconds The number of seconds to subtract
     *
     * @return self
     */
    public function subSeconds(int $seconds): self;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to add
     *
     * @return self
     */
    public function addMinutes(int $minutes): self;


    /**
     * Get a DateTime object for the specified number of minutes difference.
     *
     * @param int $minutes The number of minutes to subtract
     *
     * @return self
     */
    public function subMinutes(int $minutes): self;


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to add
     *
     * @return self
     */
    public function addHours(int $hours): self;


    /**
     * Get a DateTime object for the specified number of hours difference.
     *
     * @param int $hours The number of hours to subtract
     *
     * @return self
     */
    public function subHours(int $hours): self;
}
