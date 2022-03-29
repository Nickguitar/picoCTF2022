<?php
$msg = file_get_contents("message.txt");
$splitted = str_split($msg, 3);
foreach($splitted as $chunk)
	echo preg_replace("/(.)(.)(.)/","$3$1$2",$chunk);