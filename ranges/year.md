---
layout: default
title: Year
permalink: /ranges/year/
menu: dates
---

The `Year` class is an extension of `Range` to represent a year. It can be created from a DateTime instance:

~~~php
$date = Date::now();
$year = new Year($date);
~~~

Or using its own methods:

~~~php
$year = Year::now();
$year = Year::fromInt(2012);
~~~


The range iterator also returns a year object:

~~~php
$start = Date::now();
$end = $start->addYears(2);
$range = new Range($start, $end);
foreach ($range->years() as $year) {
    echo $year->string("Y") . "\n";
}
~~~


And every `DateTime` object has a `getYear()` method to get the year for that date:

~~~php
$date = Date::now()->addYears(10);
$year = $date->getYear();
~~~

---

## Adjusting

As with the standard dates library objects, this range can also have some adjustments applied:

~~~php
$year = Year::now();
$nextYear = $year->addYears(1);
$lastYear = $year->subYears(1);
~~~
