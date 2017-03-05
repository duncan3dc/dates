---
layout: default
title: Range
permalink: /ranges/range/
menu: dates
---

The `Range` class is used to represent any arbitrary range of dates.

~~~php
$start = new Date($row["date_from"]);
$end = new Date($row["date_to"]);
$range = new Range($start, $end);
~~~

----


Once you have a range there are a few method for convenient iteration:

~~~php
foreach ($range->days() as $date) {
    echo $date->string("Y-m-d") . "\n";
}
foreach ($range->months() as $month) {
    echo $month->string("Y-m") . "\n";
}
foreach ($range->years() as $year) {
    echo $year->string("Y") . "\n";
}
~~~


You can also count the number of elements in an interator, using the count method or the standard count function:

~~~php
echo count($range->days()) . "days\n";
echo $range->months()->count() . "months\n";
~~~

----


After creating a range you can still access the start/end objects:

~~~php
$start = $range->getStart();
$end = $range->getEnd();
~~~

This is particularly useful as you can call methods on the start/end objects,
For example, you could check if the first or last day of the month is a certain day:

~~~php
$startsOnMonday = $range->getStart()->isMonday();
$endsOnMonday = $range->getEnd()->isMonday();
~~~
