#!/usr/bin/php
<?php

$message = file_get_contents("message.txt");
$msg_arr = explode(" ", $message);
$charset = array_merge(range("A", "Z"), range(0, 9), ["_"]);

echo "picoCTF{";
foreach($msg_arr as $byte)
	echo $charset[inverse($byte, 41)-1];
echo "}";

function inverse($num, $mod){
	for($i=0;$i<$mod;$i++){
		$result = ($num*$i) % $mod;
		if($result == 1)
			return $i;
	}
}

//echo inverse(3, 7);