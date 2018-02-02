# Class SQLQueryBuilder - Documentation

## Table of Contents

* [SQLQueryBuilder](#sqlquerybuilder)
    * [__construct](#__construct)
    * [Select](#select)
    * [Where](#where)
    * [Order](#order)
    * [Insert](#insert)
    * [Update](#update)
    * [Delete](#delete)

## SQLQueryBuilder

Class SQLQueryBuilder



* Full name: \ramon1611\Libs\SQLQueryBuilder


### __construct

Constructor

```php
SQLQueryBuilder::__construct(  ): void
```







---

### Select

Generates a select statement

```php
SQLQueryBuilder::Select( string $table, array $columns = self::SELECT_ALL_COLUMNS, boolean $end = true, boolean $distinct = false ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$table` | **string** | The table to select |
| `$columns` | **array** | The columns to select. Default is SQLQueryBuilder::SELECT_ALL_COLUMNS |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |
| `$distinct` | **boolean** | Determines if the DISTINCT statement is used. Default is FALSE |


**Return Value:**

Returns the generated statement or FALSE on error



---

### Where

Generates a where statement

```php
SQLQueryBuilder::Where( string $condition, boolean $end = true ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$condition` | **string** | The condition string of the WHERE statement |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |


**Return Value:**

Returns the generated statement or FALSE on error



---

### Order

Generates a order statement

```php
SQLQueryBuilder::Order( array $columns, string $order = &#039;ASC&#039;, boolean $end = true ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$columns` | **array** | Columns to sort by |
| `$order` | **string** | Determines in which order the results are sorted. Default is 'ASC' |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |


**Return Value:**

Returns the generated statement or FALSE on error



---

### Insert

Generates a insert statement

```php
SQLQueryBuilder::Insert( string $table, array $columns, array $values, boolean $end = true ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$table` | **string** | Table to insert |
| `$columns` | **array** | Columns into which the values are inserted |
| `$values` | **array** | Values to be inserted |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |


**Return Value:**

Returns the generated statement or FALSE on error



---

### Update

Generates a update statement

```php
SQLQueryBuilder::Update( string $table, array $valuePairs, string $condition, boolean $end = true ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$table` | **string** | Table to update |
| `$valuePairs` | **array** | An array with pairs of columns and values |
| `$condition` | **string** | The condition string. If empty, all entries are updated |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |


**Return Value:**

Returns the generated statement or FALSE on error



---

### Delete

Generates a delete statement

```php
SQLQueryBuilder::Delete( string $table, string $condition, boolean $end = true ): mixed
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$table` | **string** | Table to delete entries |
| `$condition` | **string** | The condition string |
| `$end` | **boolean** | Determines if the statement is terminated. Default value is TRUE |


**Return Value:**

Returns the generated statement or FALSE on error



---



--------
> This document was automatically generated from source code comments on 2018-02-02 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
