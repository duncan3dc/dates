---
layout: default
title: Month
permalink: /ranges/month/
menu: dates
---

The `Month` class is an extension of `Range` to represent a month. It can be created from a DateTime instance:

~~~php
$date = Date::now();
$month = new Month($date);
~~~

Or using it's own now method:

~~~php
$year = Month::now();
~~~


The range iterator also returns a month object:

~~~php
$start = Date::now();
$end = $start->addYears(1);
$range = new Range($start, $end);
foreach ($range->months() as $month) {
    echo $month->string("Y") . "\n";
}
~~~


And every `DateTime` object has a `getMonth()` method to get the month for that date:

~~~php
$date = Date::now();
$month = $date->getMonth();
~~~

---

## Adjusting

As with the standard dates library objects, this range can also have some adjustments applied:

~~~php
$month = Month::now();
$nextYear = $month->addYears(1);
$lastYear = $month->subYears(1);

$nextMonth = $month->addMonths(1);
$lastMonth = $month->subMonths(1);
~~~
