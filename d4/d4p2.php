<?php

$newFile = $file = array_map(str_split(...), explode("\n", rtrim(file_get_contents(__DIR__ . '/d4.txt'))));

$removed = 0;

function myJoin(array $array)
{
	return join('', $array);
}

do
{
	$file = $newFile;
	for ($y = 0; $y < count($file); $y++)
	{
		for ($x = 0; $x < count($file[0]); $x++)
		{
			if ($file[$y][$x] !== '@')
			{
				$newFile[$y][$x] = '';
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

			if ($rollsSeen < 4)
			{
				$removed++;
				$newFile[$y][$x] = '';
			}
			else
			{
				$newFile[$y][$x] = '@';
			}
		}
	}
}
while (join('', array_map(myJoin(...), $file)) !== join('', array_map(myJoin(...), $newFile)));

echo $removed, "\n";
