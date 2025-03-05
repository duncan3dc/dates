Changelog
=========

## x.y.z - UNRELEASED

--------

## 2.0.0 - 2025-03-05

### Changed

* [Support] Added support for PHP 8.2, 8.3, and 8.4.
* [Support] Dropped support for PHP 7.2, 7.3, and 7.4.
* [DateTime] Added parameter/return types to all methods.
* [DateTime] Refactored to prevent inheritance and reduce traits.

### Added

* [DateTime] Added interfaces for all code intended to be used externally.

### Removed

* [Date] Deprecated instantiation of this class, only static methods should be used.

--------

## 1.4.0 - 2022-09-06

### Added

* [Support] Added support for PHP 7.3, 7.4, 8.0, and 8.1.
* [Support] Dropped support for PHP 5.6, 7.0, and 7.1.

### Removed

* Removed the deprecated nextDay(), nextMonth(), nextYear(), prevDay(), prevMonth(), and prevYear() methods.

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
