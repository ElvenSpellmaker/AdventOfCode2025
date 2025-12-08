<?php

ini_set('memory_limit', "588M");

$file = array_map(fn(string $i) => explode(',', $i), explode("\n", rtrim(file_get_contents(__DIR__ . '/d8.txt'))));

$circuits = [];
$seen = [];

// $iterations = 10;
$iterations = 1000;

class MinHeap extends SplHeap
{
	public function compare(mixed $value, mixed $value2) : int
	{
		return $value2['distance'] <=> $value['distance'];
	}
}

$minHeap = new MinHeap;

foreach ($file as $k => $jBox)
{
	[$x, $y, $z] = $jBox;
	$file2 = $file;
	unset($file2[$k]);

	foreach ($file2 as $k => [$x2, $y2, $z2])
	{
		$distance = sqrt(($x - $x2) ** 2 + ($y - $y2) ** 2 + ($z - $z2) ** 2);

		$minHeap->insert(['from' => $jBox, 'to' => [$x2, $y2, $z2], 'distance' => $distance]);
	}
}

while ($iterations--)
{
	do
	{
		$connection = $minHeap->extract();
		$fromKey = "{$connection['from'][0]}:{$connection['from'][1]}:{$connection['from'][2]}";
		$toKey = "{$connection['to'][0]}:{$connection['to'][1]}:{$connection['to'][2]}";
	}
	while (isset($seen[$fromKey][$toKey]) || isset($seen[$toKey][$fromKey]));

	$seen[$fromKey][$toKey] = true;

	foreach($circuits as $k => &$circuit)
	{
		if (array_key_exists($fromKey, $circuit))
		{
			$circuits2 = $circuits;
			unset($circuits2[$k]);
			foreach ($circuits2 as $k2 => &$circuit2)
			{
				if (array_key_exists($toKey, $circuit2))
				{
					unset($circuits2[$k2]);
					$circuits2[] = array_merge($circuit, $circuit2);
					$circuits = $circuits2;

					continue 3;
				}
			}

			$circuits[$k][$fromKey] = true;
			$circuits[$k][$toKey] = true;
			continue 2;
		}

		if (array_key_exists($toKey, $circuit))
		{
			$circuits2 = $circuits;
			unset($circuits2[$k]);
			foreach ($circuits2 as $k2 => &$circuit2)
			{
				if (array_key_exists($fromKey, $circuit2))
				{
					unset($circuits2[$k2]);
					$circuits2[] = array_merge($circuit, $circuit2);
					$circuits = $circuits2;

					continue 3;
				}
			}

			$circuits[$k][$fromKey] = true;
			$circuits[$k][$toKey] = true;
			continue 2;
		}
	}

	$circuits[] = [$fromKey => true, $toKey => true];
}

$maxHeap = new SplMaxHeap;
array_map(fn($circuit) => $maxHeap->insert(count($circuit)), $circuits);

echo $maxHeap->extract() * $maxHeap->extract() * $maxHeap->extract(), "\n";
