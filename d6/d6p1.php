<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d6.txt')));

preg_match_all('%[\+|\*]%', array_pop($file), $operators);

$sum = 0;

$columns = [];
foreach($file as $line)
{
	preg_match_all('%\d+%', $line, $matches);
	$columns[] = $matches[0];
}

foreach ($columns[0] as $i => $_)
{
	$column = array_column($columns, $i);

	$sum += ($operators[0][$i] === '*') ? array_product($column) : array_sum($column);
}

echo $sum, "\n";
