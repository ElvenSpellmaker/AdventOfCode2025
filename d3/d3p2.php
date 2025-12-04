<?php

$file = explode("\n", rtrim(file_get_contents(__DIR__ . '/d3.txt')));

$power = 0;

foreach ($file as $line)
{
	$powers = '';
	$len = strlen($line);
	$pos = 0;
	$endPos = -11;

	while (strlen($powers) < 12)
	{
		$sub = substr($line, $pos, $endPos);

		for ($i = 9; $i > 0; $i--)
		{
			$powerPos = strpos($sub, $i);
			if ($powerPos !== false)
			{
				break;
			}
		}

		$pos = $pos + $powerPos;
		$powers .= $line[$pos++];
		$endPos >= -1 ? $endPos = $len : $endPos++;
	}

	$power += $powers;
}

echo $power, "\n";
