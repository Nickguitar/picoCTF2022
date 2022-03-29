#!/usr/bin/php

<?php

$correct = '';
for($j=0;$j<8;$j++){
	$times = [];
	for($i=0;$i<=9;$i++){
		$start = microtime(true);
		$num = $correct.$i;
		$num = str_pad($num, 8, "0");
		exec("echo ${num} | ./pin_checker");
		$end = microtime(true);
		$total = (float)$end - (float)$start;
		echo $i.": ". $total."s\n";
		array_push($times, (string) $total);
	}
	$correct .= array_flip($times)[max($times)];
	echo "PIN: ".str_pad($correct,8,"*")."\n";
}

system("echo -n $correct | ./pin_checker");