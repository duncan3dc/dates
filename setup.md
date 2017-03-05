---
layout: default
title: Setup
permalink: /setup/
---

All classes are in the `duncan3dc\Dates` namespace.  

The DateTime class is the main class within the library. It is created using a unix timestamp:

~~~php
$date = new DateTime($row["date_created"]);
~~~

Or there is a static method to create an instance using [mktime()](http://php.net/manual/en/function.mktime.php):

~~~php
$date = DateTime::mktime($hour, $minute, $second, $month, $day, $year);
~~~

There is also a Date class which is created using a unix timestamp too, but the time element is ignored, and will always be mid-day.

~~~php
$date = new Date($row["date_created"]);
~~~

There is also a static method similar to `mktime()`

~~~php
$date = Date::mkdate($year, $month, $day);
~~~

<br>

----

## Current date/time

Each class has a helper method to get an instance based on the current date:

~~~php
$date = Date::now();
~~~

~~~php
$date = DateTime::now();
~~~
