---
layout: default
title: Day Helpers
permalink: /usage/day-helpers/
menu: dates
---

Every `DateTime` instance has the following methods to check if is a particular day:

~~~php
$date->isMonday();
$date->isTuesday();
$date->isWednesday();
$date->isThursday();
$date->isFriday();
$date->isSaturday();
$date->isSunday();
~~~

You can also check for weekends or weekdays:

~~~php
$date->isWeekday();
$date->isWeekend();
~~~

And even if a date is a bank holiday:

~~~php
$date->isBankHoliday();
~~~
