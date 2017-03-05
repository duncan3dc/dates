---
layout: default
title: Adjusting
permalink: /usage/adjusting/
menu: dates
---

All objects in the dates library are [immutable](http://en.wikipedia.org/wiki/Immutable_object), but it's still possible to 'adjust' them by creating new objects with a date relative to the original object, like so:

~~~php
$date = Date::mktime(2014, 1, 1);
$date->addYears(1)->string("Y-m-d");    # "2015-01-01"
~~~

The above works because the string method is [chained](http://en.wikipedia.org/wiki/Method_chaining) to the new object returned by `addyears()`.  
The important thing to remember is that you always need the return value of an adjustment call, doing the following is useless:

~~~php
$date = Date::now();
for ($i = 0; $i < 10; $i++) {
    $date->addYears($i);
    echo $date->string("Y");
}
~~~

In the above code the `$date` object is never changed so will always output the current year. In order to mimic mutability you can set the `$date` variable to the return of the adjustment:

~~~php
$date = Date::now();
for ($i = 0; $i < 10; $i++) {
    $date = $date->addYears($i);
    echo $date->string("Y");
}
~~~

## Relative Dates

The following adjustment methods are available for getting relative dates:

~~~php
$date->addYears($years);
$date->subYears($years);

$date->addMonths($months);
$date->subMonths($months);

$date->addWeeks($weeks);
$date->subWeeks($weeks);

$date->addDays($days);
$date->subDays($days);
~~~


## Relative Times

And there are a few methods for getting relative times:

~~~php
$date->addHours($hours);
$date->subHours($hours);

$date->addMinutes($minutes);
$date->subMinutes($minutes);

$date->addSeconds($seconds);
$date->subSeconds($seconds);
~~~


## Relative Days

It's common to need a specific day in the future or past, you can use `getNext()` and `getPrevious()` for this:

```php
$nextMonday = $date->getNext(Days::MONDAY);
$lastSaturday = $date->getPrevious(Days::SATURDAY);
```

These methods will always get the "next" or "previous" day, they don't include the current day, if you want to then you can do something like this:

```php
if (!$date->isMonday()) {
    $date = $date->getNext(Days::MONDAY);
}
```
