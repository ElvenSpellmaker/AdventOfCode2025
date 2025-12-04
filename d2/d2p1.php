<?php

preg_match_all('%(\d+)-(\d+)%', rtrim(file_get_contents(__DIR__ . '/d2.txt')), $matches);

$invalid = 0;

for ($i = 0; $i < count($matches[1]); $i++)
{
	for($j = $matches[1][$i]; $j <= $matches[2][$i]; $j++)
	{
		$strlen = strlen($j);
		if ($strlen % 2 !== 0)
		{
			$j = 10 ** $strlen;
			continue;
		}

		$halfLen = $strlen / 2;
		substr($j, 0, $halfLen) === substr($j, $halfLen) && $invalid += $j;
	}
}

echo $invalid, "\n";
