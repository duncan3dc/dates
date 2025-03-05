<?php

namespace duncan3dc\Dates\Helpers;

use duncan3dc\Dates\Date;
use duncan3dc\Dates\Interfaces\DateTimeInterface;

/**
 * Check if this instance is a bank holiday.
 */
final class BankHoliday
{
    /**
     * Check if this object is a bank holiday.
     */
    public static function isBankHoliday(DateTimeInterface $date): bool
    {
        return (
               self::newYearsDay($date)
            || self::easterDays($date)
            || self::mayDays($date)
            || self::endOfAugust($date)
            || self::christmasDays($date)
        );
    }

    private static function newYearsDay(DateTimeInterface $date): bool
    {
        # If it's not January, or it's after the 3rd then it's not a bank holiday
        if ($date->numeric("m") > 1 || $date->numeric("d") > 3) {
            return false;
        }

        # If it's the 1st or the 1st was a weekend and it's now monday then it's a bank holiday
        if ($date->numeric("d") === 1 || $date->isMonday()) {
            return true;
        }

        return false;
    }

    private static function easterDays(DateTimeInterface $date): bool
    {
        $easter = Date::make(easter_date($date->numeric("Y")));

        # Check if it's good friday
        if ($date->numeric("Ymd") === $easter->subDays(2)->numeric("Ymd")) {
            return true;
        }

        # Check if it's easter monday
        if ($date->numeric("Ymd") === $easter->addDays(1)->numeric("Ymd")) {
            return true;
        }

        return false;
    }

    private static function mayDays(DateTimeInterface $date): bool
    {
        # If it's not May then it's not a bank holiday
        if ($date->numeric("m") !== 5) {
            return false;
        }

        # If it's the first monday of the month
        if ($date->numeric("d") <= 7 && $date->isMonday()) {
            return true;
        }

        # If it's the last monday of the month
        if ($date->numeric("d") >= 25 && $date->isMonday()) {
            return true;
        }

        return false;
    }

    private static function endOfAugust(DateTimeInterface $date): bool
    {
        # If it's not August then it's not a bank holiday
        if ($date->numeric("m") !== 8) {
            return false;
        }

        # If it's the last monday of the month
        if ($date->numeric("d") >= 25 && $date->isMonday()) {
            return true;
        }

        return false;
    }

    private static function christmasDays(DateTimeInterface $date): bool
    {
        # If it's not December then it's not a bank holiday
        if ($date->numeric("m") !== 12) {
            return false;
        }

        # Move the christmas day bank holiday if it's a weekend
        $christmas = Date::mkdate($date->numeric("Y"), 12, 25);
        while ($christmas->isWeekend()) {
            $christmas = $christmas->addDays(1);
        }
        if ($date->string("Ymd") === $christmas->string("Ymd")) {
            return true;
        }

        # Move the boxing day bank holiday if it's a weekend
        $boxing = $christmas->addDays(1);
        while ($boxing->isWeekend()) {
            $boxing = $boxing->addDays(1);
        }
        if ($date->string("Ymd") === $boxing->string("Ymd")) {
            return true;
        }

        return false;
    }
}
