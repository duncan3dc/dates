<?php

namespace duncan3dc\Dates\Helpers;

use function date;
use function preg_match;
use function time;

/**
 * Format a unix timestamp in a specified way.
 */
final class Formatter
{
    /**
     * Format the date using the specified format and return a number.
     */
    public static function numeric(string $format, ?int $timestamp = null): int
    {
        return (int) self::string($format, $timestamp);
    }


    /**
     * Format the date using the specified format and return a string.
     */
    public static function string(string $format, ?int $timestamp = null): string
    {
        if ($timestamp === null) {
            $timestamp = time();
        }
        return date($format, $timestamp);
    }


    /**
     * Format the date using the specified format.
     *
     * This method will convert the result to an integer if it looks like one.
     */
    public static function format(string $format, ?int $timestamp = null): string|int
    {
        $return = self::string($format, $timestamp);

        # If the result looks like a number then return it as an int
        if (preg_match("/^([1-9][0-9]+|[0-9])$/", $return)) {
            # Only attempt to cast a number in the range supported by this install
            if ($return < \PHP_INT_MAX) {
                $return = (int) $return;
            }
        }

        return $return;
    }
}
