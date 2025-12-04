<?php

preg_match_all('%(\d+)-(\d+)%', rtrim(file_get_contents(__DIR__ . '/d2.txt')), $matches);

$invalid = 0;

for ($i = 0; $i < count($matches[1]); $i++)
{
	for($j = $matches[1][$i]; $j <= $matches[2][$i]; $j++)
	{
		$strlen = strlen($j);
		$halfLen = $strlen / 2;

		for ($k = 1; $k <= $halfLen; $k++)
		{
			$split = str_split($j, $k);

			if (count(array_unique($split)) === 1)
			{
				$invalid += $j;
				continue 2;
			}
		}
	}
}

echo $invalid, "\n";
