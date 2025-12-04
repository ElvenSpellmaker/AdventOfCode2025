<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d3.txt')));

$power = 0;

foreach ($file as $line)
{
	for ($i = 9; $i > 0; $i--)
	{
		$pos = strpos($line, $i);

		if ($pos === false)
		{
			continue;
		}

		for ($j = 9; $j > 0; $j--)
		{
			$pos2 = strpos($line, $j, $pos + 1);
			if ($pos2 === false)
			{
				continue;
			}

			$power += (int)($line[$pos] . $line[$pos2]);
			break 2;
		}
	}
}

echo $power, "\n";
