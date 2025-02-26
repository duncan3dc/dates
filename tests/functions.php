<?php

namespace duncan3dc\DateTests;

use function mktime;

function testtime(int $year, int $month, int $day, int $hour = 12, int $minute = 0, int $second = 0): int
{
    return (int) mktime($hour, $minute, $second, $month, $day, $year);
}
