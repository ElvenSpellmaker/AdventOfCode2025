<?php

$zeroLand = 0;

$file = explode("\n",rtrim(file_get_contents(__DIR__ . '/d1.txt')));

array_reduce($file, function($carry, $item) use (&$zeroLand): int {
	[$letter, $number] = [$item[0], substr($item, 1)];
	$number = $letter === 'L' ? -$number : $number;
	$carry = (($carry + $number) % 100);
	$carry = $carry < 0 ? (100 + $carry) : $carry;
	$carry === 0 && $zeroLand++;
	return $carry;
}, 50);

echo $zeroLand, "\n";
