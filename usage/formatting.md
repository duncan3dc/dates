---
layout: default
title: Formatting
permalink: /usage/formatting/
menu: dates
---

There a few options available for formatting your date object. The easist way is to use the `format()` method:

~~~php
$date->format("Y-m-d");
~~~

This method accepts all the format characters supported by the php [date()](http://php.net/manual/en/function.date.php) method.  
If the result looks like a number then it will be returned as an integer, otherwise it will return it as a string.


If the result is required as a particular type (string/numeric) there are methods available for this:

~~~php
$date->numeric("Ymd");
$date->string("Y-m-d");
~~~

If you just need a unix timestamp then there is a method for doing so:

~~~php
$date->timestamp();
~~~
