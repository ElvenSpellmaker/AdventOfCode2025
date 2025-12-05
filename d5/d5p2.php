<?php

$file = explode("\n\n", rtrim(file_get_contents(__DIR__ . '/d5.txt')));

$ranges = array_map(fn($i) => explode("-", $i), explode("\n", $file[0]));

$fresh = 0;

foreach ($ranges as $k => [&$low, &$high])
{
	unset($ranges[$k]);
	tryAgain:
	foreach ($ranges as $k2 => [$oLow, $oHigh])
	{
		if (
			($low >= $oLow && $low <= $oHigh) || ($high >= $oLow && $high <= $oHigh)
			|| ($oLow >= $low && $oLow <= $high) || ($oHigh >= $low && $oHigh <= $high)
		)
		{

			$low = min($low, $oLow);
			$high = max($high, $oHigh);

			unset($ranges[$k2]);

			goto tryAgain;
		}
	}

	$fresh += $high - $low + 1;
}

echo $fresh, "\n";
