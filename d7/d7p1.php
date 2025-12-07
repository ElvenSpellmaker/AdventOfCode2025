<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d7.txt')));

$splits = 0;

$beams[1][strpos($file[0], 'S')] = true;

$yLen = count($file);
$xLen = strlen($file[0]);

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
				$splits++;
				if ($newY < $yLen)
				{
					($x + 1 < $xLen) && $newBeams[$newY][$x + 1] = true;
					($x - 1 >= 0) && $newBeams[$newY][$x - 1] = true;
				}

				continue;
			}

			($newY < $yLen) && $newBeams[$newY][$x] = true;
		}
	}

	$beams = $newBeams;
}

echo $splits, "\n";
