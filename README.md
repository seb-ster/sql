# An SQL (prepared) statementbuilder
Eventually this should easily create SQL Injection proof SQL statements

* A Statment consists of Clauses.
* A Clause consists of one or a Collection of Elements
* A Collection consists of one or multiple Elements.
* A Collection is itself an Element and can therefor be nested.
* An Element is the basic building block of the SQL string.

* A Expression is an Element representing a scalar value or NULL.

* A Identifier is an Element representing a database, a table or a field.
* A Identifier can be qualified using another unqualified identifier.

* A Alias is an Element that assigns a Identifier to an Expression or another Identifier

All these objects can return a basic SQL string using `getString()` or just casting them to a string.

All these objects can return a PreparedElement using 'prepare()`.

A PreparedElement can also return a string, like every Element. But this string may contain placeholders.

A PreparedElement can return the values corresponding to the placeholders in an array, using 'getParameters()'.

# Version 0.1
Only a `SELECT` statement with or without fields, and/or a `FROM` and/or a `WHERE` clause are currently supported.
The `WHERE` clause supports multiple comparison operations. By default these are combined using the `AND`keyword.
Comparison operations can also be chained themselves using `andIs()` or `orIs()` methods.
Currently `equalTo()` (=), `lessThen()` (<) and `greaterThen()` (>) comparisons are supported.
These comparisons can be called on the basic elements that form the SQL clauses.


# 100% tested
with PHPunit 5.7.21 on PHP 5.6.25


# 1 dependency
on seb-ster/exception, which is used as a marker exception for the seb-ster namespace
