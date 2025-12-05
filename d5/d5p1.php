<?php

$file = explode("\n\n", rtrim(file_get_contents(__DIR__ . '/d5.txt')));

$ranges = array_map(fn($i) => explode("-", $i), explode("\n", $file[0]));
$ingredients = explode("\n", $file[1]);

$fresh = 0;

foreach ($ingredients as $ingredient)
{
	foreach ($ranges as [$low, $high])
	{
		if ($ingredient >= $low && $ingredient <= $high)
		{
			$fresh++;
			break;
		}
	}
}

echo $fresh, "\n";
