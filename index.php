<?php

require_once "table/Table.php";
require_once "table/Column.php";

$table = new Table(['name' => 'table_name', 'charset' => 'utf8']);

$column = [
	'name' => 'reviews',
	'type' => 'string',
	'nullable' => 'not null',
];

$column1 = new Column($column);
$column2 = new Column($column);
$column3= new Column($column);

$table->setColumns($column1, $column2, $column3);

$request = $table->getTableCreateQuery();

print($request);