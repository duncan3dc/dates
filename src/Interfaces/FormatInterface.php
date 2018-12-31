<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * Format the instance in a specified way.
 */
interface FormatInterface
{
    /**
     * Format the date using the specified format and return a number.
     *
     * @param string $format The format to apply to the date
     */
    public function numeric(string $format): int;


    /**
     * Format the date using the specified format and return a string.
     *
     * @param string $format The format to apply to the date
     */
    public function string(string $format): string;


    /**
     * Format the date using the specified format.
     *
     * This method will convert the result to an integer if it looks like one.
     *
     * @param string $format The format to apply to the date
     */
    public function format(string $format): string|int;
}
