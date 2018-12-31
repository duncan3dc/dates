<?php

namespace duncan3dc\Dates;

use duncan3dc\Dates\Interfaces\DateTimeInterface;
use duncan3dc\Dates\Interfaces\MonthInterface;
use duncan3dc\Dates\Interfaces\YearInterface;

use function strtotime;
use function time;

/**
 * The date only portion of a DateTime object.
 */
final class Date implements DateTimeInterface
{
    private DateTimeInterface $date;


    public static function make(int $timestamp): DateTimeInterface
    {
        $date = new DateTime($timestamp);
        return new DateTime($date->midday());
    }


    /**
     * Create a new DateTime object representing the current date.
     */
    public static function now(): DateTimeInterface
    {
        return self::make(time());
    }


    public static function parse(string|int $date, string|int|null $time = null): DateTimeInterface
    {
        return DateTime::parse($date, $time);
    }


    public static function fromFormat(string $format, string $date): DateTimeInterface
    {
        return self::make(DateTime::fromFormat($format, $date)->timestamp());
    }


    /**
     * Create a new DateTime object from a set of individual parts.
     */
    public static function mkdate(int $year, int $month, int $day): DateTimeInterface
    {
        return DateTime::mktime(12, 0, 0, $month, $day, $year);
    }


    /**
     * Convert a free format date to an instance.
     *
     * @param string $date The date to parse
     */
    public static function strtotime(string $date): DateTimeInterface
    {
        return self::make(strtotime($date));
    }


    /**
     * @deprecated use Date::make($unix) instead
     */
    public function __construct(int $unix)
    {
        $date = new DateTime($unix);
        $this->date = new DateTime($date->midday());
    }


    /**
     * @deprecated use Date::make($unix) instead
     */
    public function __call(string $name, array $arguments)
    {
        return $this->date->$name(...$arguments);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function timestamp(): int
    {
        return $this->date->timestamp();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function getMonth(): MonthInterface
    {
        return $this->date->getMonth();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function getYear(): YearInterface
    {
        return $this->date->getYear();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function midday(): int
    {
        return $this->date->midday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function start(): int
    {
        return $this->date->start();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function end(): int
    {
        return $this->date->end();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isBankHoliday(): bool
    {
        return $this->date->isBankHoliday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isDay(int $day): bool
    {
        return $this->date->isDay($day);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isMonday(): bool
    {
        return $this->date->isMonday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isTuesday(): bool
    {
        return $this->date->isTuesday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isWednesday(): bool
    {
        return $this->date->isWednesday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isThursday(): bool
    {
        return $this->date->isThursday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isFriday(): bool
    {
        return $this->date->isFriday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isSaturday(): bool
    {
        return $this->date->isSaturday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isSunday(): bool
    {
        return $this->date->isSunday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isWeekday(): bool
    {
        return $this->date->isWeekday();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function isWeekend(): bool
    {
        return $this->date->isWeekend();
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function getPrevious(int $day): DateTimeInterface
    {
        return $this->date->getPrevious($day);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function getNext(int $day): DateTimeInterface
    {
        return $this->date->getNext($day);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withYear(int $year): DateTimeInterface
    {
        return $this->date->withYear($year);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withMonth(int $month): DateTimeInterface
    {
        return $this->date->withMonth($month);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withDay(int $day): DateTimeInterface
    {
        return $this->date->withDay($day);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withHours(int $hour): DateTimeInterface
    {
        return $this->date->withHours($hour);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withMinutes(int $minute): DateTimeInterface
    {
        return $this->date->withMinutes($minute);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function withSeconds(int $second): DateTimeInterface
    {
        return $this->date->withSeconds($second);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addDays(int $days): DateTimeInterface
    {
        return $this->date->addDays($days);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subDays(int $days): DateTimeInterface
    {
        return $this->date->subDays($days);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addWeeks(int $weeks): DateTimeInterface
    {
        return $this->date->addWeeks($weeks);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subWeeks(int $weeks): DateTimeInterface
    {
        return $this->date->subWeeks($weeks);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addMonths(int $months): DateTimeInterface
    {
        return $this->date->addMonths($months);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subMonths(int $months): DateTimeInterface
    {
        return $this->date->subMonths($months);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addYears(int $years): DateTimeInterface
    {
        return $this->date->addYears($years);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subYears(int $years): DateTimeInterface
    {
        return $this->date->subYears($years);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addSeconds(int $seconds): DateTimeInterface
    {
        return $this->date->addSeconds($seconds);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subSeconds(int $seconds): DateTimeInterface
    {
        return $this->date->subSeconds($seconds);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addMinutes(int $minutes): DateTimeInterface
    {
        return $this->date->addMinutes($minutes);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subMinutes(int $minutes): DateTimeInterface
    {
        return $this->date->subMinutes($minutes);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function addHours(int $hours): DateTimeInterface
    {
        return $this->date->addHours($hours);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function subHours(int $hours): DateTimeInterface
    {
        return $this->date->subHours($hours);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function numeric(string $format): int
    {
        return $this->date->numeric($format);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function string(string $format): string
    {
        return $this->date->string($format);
    }


    /**
     * @deprecated use Date::make() instead
     */
    public function format(string $format): string|int
    {
        return $this->date->format($format);
    }
}
