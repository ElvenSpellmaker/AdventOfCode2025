<?php

$file = array_map(str_split(...), explode("\n", rtrim(file_get_contents(__DIR__ . '/d4.txt'))));

$reachable = 0;

for ($y = 0; $y < count($file); $y++)
{
	for ($x = 0; $x < count($file[0]); $x++)
	{
		if ($file[$y][$x] !== '@')
		{
			continue;
		}

		$rollsSeen = 0;

		$rollsSeen += ($file[$y - 1][$x - 1] ?? '') === '@';
		$rollsSeen += ($file[$y - 1][$x] ?? '') === '@';
		$rollsSeen += ($file[$y - 1][$x + 1] ?? '') === '@';
		$rollsSeen += ($file[$y][$x - 1] ?? '') === '@';
		$rollsSeen += ($file[$y][$x + 1] ?? '') === '@';
		$rollsSeen += ($file[$y + 1][$x - 1] ?? '') === '@';
		$rollsSeen += ($file[$y + 1][$x] ?? '') === '@';
		$rollsSeen += ($file[$y + 1][$x + 1] ?? '') === '@';

		$reachable += $rollsSeen < 4;
	}
}

echo $reachable, "\n";
