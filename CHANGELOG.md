Changelog
=========

## x.y.z - UNRELEASED

--------

## 1.3.0 - 2017-08-14

### Added

* [DateTime] Add a strtotime() method to make use of the standard php parsing.

--------

## 1.2.1 - 2017-07-24

### Added

* [Support] Add support for PHP 7.2

### Fixed

* [DateTime] Ensure single digits are treated as numbers by format().

--------

## 1.2.0 - 2017-03-05

### Added

* [Docs] Created a changelog!
* [Ranges] Add a asString() method to generate human-readble range descriptions.
* [DateTime] Add getNext()/getPrevious() methods to get the next or previous tuesday/wednesday/etc.
* [Support] Add support for PHP 7.1

### Fixed

* [Date] Ensure Date::parse() returns a Date instance, not DateTime.

--------
