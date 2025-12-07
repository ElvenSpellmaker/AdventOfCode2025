<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d7.txt')));

$beams[1][strpos($file[0], 'S')] = 1;

$yLen = count($file);
$xLen = strlen($file[0]);

$splits = 0;

while(count($beams))
{
	$newBeams = [];
	foreach ($beams as $y => $beamLine)
	{
		$newY = $y + 1;
		foreach ($beamLine as $x => $_)
		{
			if (($file[$newY][$x] ?? '') === '^')
			{
				if ($newY < $yLen)
				{
					($x + 1 < $xLen) && $newBeams[$newY][$x + 1] = $beams[$y][$x] + ($newBeams[$newY][$x + 1] ?? 0);
					($x - 1 >= 0) && $newBeams[$newY][$x - 1] = $beams[$y][$x] + ($newBeams[$newY][$x - 1] ?? 0);
				}

				continue;
			}

			($newY < $yLen) && $newBeams[$newY][$x] = $beams[$y][$x] + ($newBeams[$newY][$x] ?? 0);
		}

		$prevSplits = $splits;
		$splits = array_sum(array_map(array_sum(...), $newBeams));
	}

	$beams = $newBeams;
}

echo $prevSplits, "\n";
