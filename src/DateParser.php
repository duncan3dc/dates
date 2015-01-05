<?php

namespace duncan3dc\Dates;

/**
 * Parse dates/times in a variety of formats and create a DateTime object.
 */
class DateParser extends DateTime
{
    /**
     * Create a new instance from a parsable date/time.
     *
     * @param string|int The date to parse
     * @param string|int The time to parse
     */
    public function __construct($date, $time = null)
    {
        if (!$date = trim($date)) {
            throw new \InvalidArgumentException("No date was passed");
        }

        if (preg_match("/[a-z]/i", $date)) {
            throw new \InvalidArgumentException("Invalid character found in date, (" . $date . ")");
        }

        # Human readable universal format (yyyy-mm-dd)
        if (preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $date, $matches)) {
            $time = $this->parseTime($time);
            parent::__construct(mktime($time["h"], $time["m"], $time["s"], $matches[2], $matches[3], $matches[1]));
            return;
        }

        # Sql date format (yyyy-mm-dd hh:ii:ss) (with optional milliseconds)
        if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})[\s-]([0-9]{2})[:\.]([0-9]{2})[:\.]([0-9]{2})(\.[0-9]{6})?$/", $date, $matches)) {
            parent::__construct(mktime($matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1]));
            return;
        }

        # Human readable format (d/m/y or d-m-y)
        if (strpos($date, "/") || strpos($date, "-")) {
            $char = strpos($date, "/") ? "/" : "-";
            if (!$time && strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            }

            list($d, $m, $y) = explode($char, $date);
            $time = $this->parseTime($time);
            parent::__construct(mktime($time["h"], $time["m"], $time["s"], $m, $d, $y));
            return;
        }

        # Sortable format (YmdHi/YmdHis)
        if ($date > 200000000000) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);
            $h = substr($date, 8, 2);
            $i = substr($date, 10, 2);
            $s = substr($date, 12, 2);
            parent::__construct(mktime($h, $i, $s, $m, $d, $y));
            return;
        }

        # Sortable format (Year and month only)
        if ($date < 999999) {
            $y = floor($date / 100);
            $m = $date % 100;
            parent::__construct(mktime(12, 0, 0, $m, 1, $y));
            return;
        }

        # IBM DB2 format (cymd with optional separate time)
        if ($date < 9999999) {
            $y = floor($date / 10000) + 1900;
            $m = floor(($date / 100) % 100);
            $d = $date % 100;

            if (!$time && strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            }
            $time = $this->parseTime($time);

            parent::__construct(mktime($time["h"], $time["m"], $time["s"], $m, $d, $y));
            return;
        }

        # Sortable format (Ymd with optional separate time)
        if ($date < 99999999) {
            $y = substr($date, 0, 4);
            $m = substr($date, 4, 2);
            $d = substr($date, 6, 2);

            if (!$time && strpos($date, " ")) {
                list($date, $time) = explode(" ", $date);
            }
            $time = $this->parseTime($time);

            parent::__construct(mktime($time["h"], $time["m"], $time["s"], $m, $d, $y));
            return;
        }

        if ($unix = (int) date("U", $date)) {
            parent::__construct($unix);
            return;
        }

        throw new \InvalidArgumentException("An unparsable date was passed (" . $date . ")");
    }


    /**
     * Convert the time to an array of hours, minutes and seconds.
     *
     * @param string|int $time The value to parse.
     *
     * @return array
     */
    protected function parseTime($time)
    {
        $return = [
            "h" =>  12,
            "m" =>  0,
            "s" =>  0,
        ];

        if (!$time) {
            return $return;
        }

        if (preg_match("/[a-z]/i", $time)) {
            return $return;
        }

        # Human readable format (h:i:s)
        if (strpos($time, ":")) {
            $bits = explode(":", $time);
            return [
                "h" =>  $bits[0],
                "m" =>  isset($bits[1]) ? $bits[1] : 0,
                "s" =>  isset($bits[2]) ? $bits[2] : 0,
            ];
        }

        # Sortable format (His)
        return [
            "h" =>  floor($time / 10000),
            "m" =>  floor(($time / 100) % 100),
            "s" =>  $time % 100,
        ];
    }
}
