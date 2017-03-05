---
layout: default
title: Parsing
permalink: /usage/parsing/
menu: dates
---

There are multiple methods for creating date objects, the easiest of which is the static `parse()` method:

~~~php
$date = Date::parse("2008-02-22");
~~~

The following date formats are supported:

```
Format      | Description               | Example
----------------------------------------------------
yyyy-mm-dd  | Human readable universal  | 2014-09-14
dd-mm-yyyy  | Human readable (british)  | 22-08-2014
dd/mm/yyyy  | Human readable (british)  | 17/06/2014
dd-mm-yy    | Human readable (british)  | 22-08-12
dd/mm/yy    | Human readable (british)  | 17/06/13
yyyymmdd    | Sortable numeric          | 20140930
yyyymm      | Numeric year and month    | 201305
```

The parse method is also available on the DateTime class:

~~~php
$date = DateTime::parse("2014-12-31", "14:30:00");
~~~

The following time formats are supported:

```
Format      | Description               | Example
--------------------------------------------------
hh:mm:ss    | Human readable universal  | 16:59:00
hh:mm       | Human readable universal  | 09:30
hhmmss      | Sortable numeric          | 43000
```

It also accepts a single parameter containing both date and time:

~~~php
$date = DateTime::parse("2014-10-01-17:30:00.000000");
~~~

The following formats are supported:

```
Format            | Description           | Example
----------------------------------------------------------
Y-m-d-hh:mm:ss.u  | IBM DB2 SQL DateTime  | 2014-09-03-16:59:00
YmdHis            | Sortable numeric      | 20140930112055
YmdHi             | Sortable numeric      | 201409301120
```

<br>

----

## Specifying a format

While the above code is useful and flexible, it is often more robust to only accept a specific format.  
This is also useful to support any format not available via `parse()`.  

~~~php
# Date only
$date = Date::fromFormat("Y-m-d", "2014-01-31");

# Date and time
$date = DateTime::fromFormat("d/m/Y H:i:s", "28/02/2008 06:30:12");

# An extreme example
$date = DateTime::fromFormat("F D j H/i (Y)", "March Mon 2 06/30 (2015)");
~~~
