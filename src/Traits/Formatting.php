<?php

namespace duncan3dc\Dates\Traits;

/**
 * Format the internal unix timestamp in a specified way.
 */
trait Formatting
{
    /**
     * @var int $unix Unix timestamp representing the datetime of this object
     */
    protected int $unix;


    /**
     * Format the date using the specified format and return a number.
     *
     * @var string $format The format to apply to the date
     */
    public function numeric(string $format): int
    {
        return (int) $this->string($format);
    }


    /**
     * Format the date using the specified format and return a string.
     *
     * @var string $format The format to apply to the date
     */
    public function string(string $format): string
    {
        return date($format, $this->unix);
    }


    /**
     * Format the date using the specified format.
     *
     * This method will convert the result to an integer if it looks like one.
     *
     * @var string $format The format to apply to the date
     *
     * @return string|int
     */
    public function format(string $format): string|int
    {
        $return = $this->string($format);

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
