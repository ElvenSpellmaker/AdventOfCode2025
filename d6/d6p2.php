<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d6.txt')));

preg_match_all('%[\+|\*]%', array_pop($file), $operators);

$file = array_map(str_split(...), $file);

$sum = 0;

$maxSize = max(...array_map(count(...), $file));

$columnNums = [];
$index = 0;
for ($i = 0; $i <= $maxSize; $i++)
{
	$num = trim(join('', array_column($file, $i)));

	if ($num === '')
	{
		$sum += ($operators[0][$index] === '*') ? array_product($columnNums) : array_sum($columnNums);

		$index++;
		$columnNums = [];

		continue;
	}

	$columnNums[] = $num;
}

echo $sum, "\n";
