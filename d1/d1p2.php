<?php

$zeroCount = 0;

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d1.txt')));

array_reduce($file, function($carry, $item) use (&$zeroCount): int {
	$move = substr($item, 1);

	for ($i = 0, $gtZero = ($item[0] === 'L' ? -$move : $move) > 0; $i < $move; $i++)
	{
		$carry = ($gtZero ? ($carry + 1) : ($carry + 99)) % 100;
		if ($carry === 0) $zeroCount++;
	}

	return $carry;
}, 50);

echo $zeroCount . "\n";
