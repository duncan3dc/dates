<?php

namespace duncan3dc\Dates\Interfaces;

/**
 * Format the internal unix timestamp in a specified way.
 */
interface FormatInterface
{
    /**
     * Format the date using the specified format and return a number.
     *
     * @var string $format The format to apply to the date
     *
     * @return int
     */
    public function numeric(string $format): int;


    /**
     * Format the date using the specified format and return a string.
     *
     * @var string $format The format to apply to the date
     *
     * @return string
     */
    public function string(string $format): string;


    /**
     * Format the date using the specified format.
     *
     * This method will convert the result to an integer if it looks like one.
     *
     * @var string $format The format to apply to the date
     *
     * @return string|int
     */
    public function format(string $format);
}